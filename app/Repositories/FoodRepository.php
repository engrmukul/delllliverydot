<?php

namespace App\Repositories;

use App\Contracts\FoodContract;
use App\Models\Extra;
use App\Models\Food;
use App\Models\FoodVariant;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\DataTables;

class FoodRepository extends BaseRepository implements FoodContract
{
    /**
     * FoodRepository constructor.
     * @param Food $model
     */
    public function __construct(Food $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFood(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = Food::latest()->get();

        return Datatables::of($query)->with('categories','restaurants')
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('foods.edit', [$row->id]) . '" title="Food Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('foods.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->editColumn('category', function ($row) {
                return $row->categories->name;
            })
            ->editColumn('restaurant', function ($row) {
                return $row->restaurants->name;
            })->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img class="image_preview food_preview" src="%s" width="50px" height="50px"></a>',
                        $row->image,
                        $row->image
                    );
                }

                return '';
            })->rawColumns(['image', 'action'])
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findFoodById(int $id)
    {
        try {
            //return $this->findOneOrFail($id);
            return $this->model->with('foodVariants','categories','extra')->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Food|mixed
     */
    public function createFood(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $short_description =  $collection['name'];
            $description =  $collection['name'];

            if(isset($params['image'])){
                $image = url('/').'/public/img/food/'.$params['image'];
            }else{
                $image = url('/').'/public/img/food/default.png';
            }

            $merge = $collection->merge(compact('short_description','description','created_by','image'));

            $food = new Food($merge->all());

            $food->save();

            //SAVE FOOD VARIANT
            $variantArray = array();

            foreach ($collection['variant_name'] as $key => $vName){
                $variantData['food_id'] = $food->id;
                $variantData['name'] = $vName;
                $variantData['price'] = $collection['variant_price'][$key];

                $variantArray[] = $variantData;
            }

            FoodVariant::insert($variantArray);

            //SAVE FOOD EXTRA
            $extraArray = array();

            if(isset($collection['extra_name'][0]) AND !empty($collection['extra_name'][0]) AND $collection['extra_name'][0] !=null){
                foreach ($collection['extra_name'] as $ekey => $eName){
                    $extraData['food_id'] = $food->id;
                    $extraData['name'] = $eName;
                    $extraData['price'] = $collection['extra_price'][$ekey];
                    $extraData['created_by'] = auth()->user()->id;

                    $extraArray[] = $extraData;
                }

                Extra::insert($extraArray);
            }


            return $food;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFood(array $params)
    {
        $food = $this->findFoodById($params['id']);

        $collection = collect($params)->except('_token');

        $short_description =  $collection['name'];
        $description =  $collection['name'];

        $updated_by = auth()->user()->id;

        $updated_at = date('Y-m-d');

        if(isset($params['image'])){
            $image = url('/').'/public/img/food/'.$params['image'];
            $merge = $collection->merge(compact('short_description', 'description','updated_at','updated_by','image'));
        }else{
            $merge = $collection->merge(compact('short_description', 'description','updated_at','updated_by'));
        }


        $food->update($merge->all());

        FoodVariant::where('food_id', $collection['id'])->delete();

        //SAVE FOOD VARIANT
        $variantArray = array();

        foreach ($collection['variant_name'] as $key => $vName){
            $variantData['food_id'] = $collection['id'];
            $variantData['name'] = $vName;
            $variantData['price'] = $collection['variant_price'][$key];

            $variantArray[] = $variantData;
        }

        FoodVariant::insert($variantArray);


        //SAVE FOOD EXTRA
        $extraArray = array();

        if(isset($collection['extra_name'][0]) AND !empty($collection['extra_name'][0]) AND $collection['extra_name'][0] !=null){

            Extra::where('food_id', $collection['id'])->delete();

            foreach ($collection['extra_name'] as $ekey => $eName){
                $extraData['food_id'] = $food->id;
                $extraData['name'] = $eName;
                $extraData['price'] = $collection['extra_price'][$ekey];
                $extraData['created_by'] = auth()->user()->id;

                $extraArray[] = $extraData;
            }

            Extra::insert($extraArray);
        }

        return $food;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFood($id, array $params)
    {
        //CHECK IF FOOD USE IN ORDER
        $count = OrderDetail::where('food_id', $id)->count();

        if($count > 0){
            return false;
        }else{
            $Food = $this->findFoodById($id);
            $Food->delete();

            Extra::where('food_id', $id)->delete();

            return true;
        }
    }
}
