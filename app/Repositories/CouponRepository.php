<?php

namespace App\Repositories;

use App\Contracts\CouponContract;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\DataTables;

class CouponRepository extends BaseRepository implements CouponContract
{
    /**
     * CouponRepository constructor.
     * @param Coupon $model
     */
    public function __construct(Coupon $model)
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
    public function listCoupon(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        //$query = $this->all($columns, $order, $sort);

        $query = Coupon::latest()->get();

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="' . route('coupons.edit', [$row->id]) . '" title="Coupon Edit"><i class="fa fa-pencil"></i> '. trans("common.edit") . '</a>';

                $actions.= '
                    <form action="'.route('coupons.destroy', [$row->id]).'" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> '. trans("common.delete") . '</button>
                    </form>
                ';

                return $actions;
            })
            ->make(true);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findCouponById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Coupon|mixed
     */
    public function createCoupon(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            if(isset($collection['restaurant_id'])){
                $couponArray = array();
                foreach (array_filter($collection['restaurant_id']) as $key => $item) {
                    $couponData['code'] = $collection['code'];
                    $couponData['total_code'] = $collection['total_code'];
                    $couponData['discount_type'] = $collection['discount_type'];
                    $couponData['discount'] = $collection['discount'];
                    $couponData['minimum_order'] = $collection['minimum_order'];
                    $couponData['description'] = $collection['description'];
                    $couponData['restaurant_id'] = $item;
                    $couponData['expire_at'] = $collection['expire_at']." 00:00:00";
                    $couponData['created_by'] = $created_by;

                    $couponArray[] = $couponData;
                }

                $Coupon = Coupon::insert($couponArray);
            }else{
                $couponData['code'] = $collection['code'];
                $couponData['total_code'] = $collection['total_code'];
                $couponData['discount_type'] = $collection['discount_type'];
                $couponData['discount'] = $collection['discount'];
                $couponData['minimum_order'] = $collection['minimum_order'];
                $couponData['description'] = $collection['description'];
                $couponData['expire_at'] = $collection['expire_at']." 00:00:00";
                $couponData['created_by'] = $created_by;

                $Coupon = Coupon::insert($couponData);
            }

            return $Coupon;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCoupon(array $params)
    {
        $Coupon = $this->findCouponById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $Coupon->update($merge->all());

        return $Coupon;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCoupon($id, array $params)
    {
        $coupon = Coupon::where('id', $id)->first()->code;

        $count = Order::where('coupon_code', $coupon)->count();

        if($count > 0){
            return false;
        }else{
            $Coupon = $this->findCouponById($id);
            $Coupon->delete();
            return $Coupon;
        }
    }
}
