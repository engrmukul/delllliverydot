<?php

namespace App\Repositories;

use App\Contracts\OrderContract;
use App\Models\Order;
use App\Models\OrderVariant;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Yajra\DataTables\DataTables;

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
     * @return mixed
     */
    public function listOrder(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = Order::orderBy('order_date', 'DESC')->get();

        return Datatables::of($query)->with('customer','restaurant','rider')
            ->addColumn('action', function ($row) {
                $actions = '';

                $actions.= '<a class="btn btn-primary btn-xs float-left mr-1" href="#" title="Order Edit"><i class="fa fa-itunes"></i> '. trans("common.note") . '</a>';

                return $actions;
            })
            ->editColumn('customer_phone', function ($row) {
                return $row->customer->phone_number;
            })
            ->editColumn('restaurant', function ($row) {
                return $row->restaurant->name;
            })
            ->editColumn('restaurant_phone', function ($row) {
                return $row->restaurant->phone_number;
            })
            ->editColumn('rider', function ($row) {
                return $row->rider ? $row->rider->name : "NOT";
            })
            ->editColumn('rider_phone', function ($row) {
                return $row->rider ? $row->rider->phone_number : "NOT";
            })
            ->editColumn('order_status', function ($row) {
                return ucfirst(str_replace("_"," ", $row->order_status));
            })
            ->editColumn('payment_method', function ($row) {
                return ucfirst(str_replace("_"," ", $row->payment_method));
            })
            ->editColumn('payment_status', function ($row) {
                return ucfirst(str_replace("_"," ", $row->payment_status));
            })
            ->make(true);
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

    public function orderDetails(int $id)
    {
        try {
            return Order::with('orderDetails','customer','restaurant','rider')
                ->with('orderDetails.foods','orderDetails.foodVariants')
                ->where('id', $id)
                ->orderBy('order_date', 'DESC')
                ->first();

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Order|mixed
     */
    public function createOrder(array $params)
    {
        try {
            $collection = collect($params);

            $created_by = auth()->user()->id;

            $merge = $collection->merge(compact('created_by'));

            $order = new Order($merge->all());

            $order->save();

            //SAVE FOOD VARIANT
            $variantArray = array();

            foreach ($collection['variant_name'] as $key => $vName){
                $variantData['order_id'] = $order->id;
                $variantData['name'] = $vName;
                $variantData['price'] = $collection['variant_price'][$key];

                $variantArray[] = $variantData;
            }

            OrderVariant::insert($variantArray);

            return $order;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateOrder(array $params)
    {
        $Order = $this->findOrderById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $Order->update($merge->all());

        return $Order;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteOrder($id, array $params)
    {
        $Order = $this->findOrderById($id);

        $Order->delete();

        return $Order;
    }
}
