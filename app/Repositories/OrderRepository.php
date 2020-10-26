<?php

namespace App\Repositories;

use App\Models\Order;
use App\Contracts\OrderContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\DataTables\Facades\DataTables;

class OrderRepository extends BaseRepository implements OrderContract
{
    /**
     * OrderRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @param array $params
     * @return mixed
     */
    public function listOrder( array $params, string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        try {
            $collection = collect($params);

            return $this->model->with('orderDetails','RestaurantDetails','orderDetails.foods','orderDetails.foodVariants')->where('customer_id', $collection['customer_id'])->orderBy('id', $sort)->get($columns);

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrderById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }
}
