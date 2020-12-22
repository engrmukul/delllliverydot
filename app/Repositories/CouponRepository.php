<?php

namespace App\Repositories;

use App\Contracts\CouponContract;
use App\Models\Coupon;
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

            $merge = $collection->merge(compact('created_by'));

            $Coupon = new Coupon($merge->all());

            $Coupon->save();

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
        $Coupon = $this->findCouponById($id);

        $Coupon->delete();

        return $Coupon;
    }
}
