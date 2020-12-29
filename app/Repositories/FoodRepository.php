<?php

namespace App\Repositories;

use App\Contracts\FoodContract;
use App\Models\Food;
use App\Models\FoodVariant;
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
            })
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
            return $this->model->with('foodVariants','categories')->findOrFail($id);

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

            if(isset($params['image'])){
                $image = url('/').'/public/img/food/'.$params['image'];
            }else{
                $image = url('/').'/public/img/food/default.png';
            }

            $merge = $collection->merge(compact('created_by','image'));

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
        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        if(isset($params['image'])){
            $image = url('/').'/public/img/food/'.$params['image'];
        }else{
            $image = url('/').'/public/img/food/default.png';
        }

        $merge = $collection->merge(compact('updated_by','image'));

        //SAVE RESTAURANT
        $food = new Food($merge->all());
        $food->update();

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

        return $food;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFood($id, array $params)
    {
        $Food = $this->findFoodById($id);

        $Food->delete();

        return $Food;
    }
}
