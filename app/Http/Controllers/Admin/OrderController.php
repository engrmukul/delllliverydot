<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Point;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * @var OrderContract
     */
    protected $orderRepository;

    /**
     * OrderController constructor.
     * @param OrderContract $orderRepository
     */
    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('orders', 'orders List');
        $data = [
            'tableHeads' => [
                trans('order.SN'),
                trans('order.customer_phone'),
                trans('order.order_date'),
                trans('order.order_status'),
                trans('order.payment_method'),
                trans('order.payment_status'),
                trans('order.total_price'),
                trans('order.restaurant'),
                trans('order.restaurant_phone'),
                trans('order.rider'),
                trans('order.rider_phone'),
                trans('order.action')
            ],
            'dataUrl' => 'admin/orders/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'customer_phone', 'name' => 'customer_phone'],
                ['data' => 'order_date', 'name' => 'order_date'],
                ['data' => 'order_status', 'name' => 'order_status'],
                ['data' => 'payment_method', 'name' => 'payment_method'],
                ['data' => 'payment_status', 'name' => 'payment_status'],
                ['data' => 'total_price', 'name' => 'total_price'],
                ['data' => 'restaurant', 'name' => 'restaurant'],
                ['data' => 'restaurant_phone', 'name' => 'restaurant_phone'],
                ['data' => 'rider', 'name' => 'rider'],
                ['data' => 'rider_phone', 'name' => 'rider_phone'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false]
            ],
        ];
        return view('admin.orders.index', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData(Request $request)
    {
        return $this->orderRepository->listOrder($request);
    }

    public function view($id)
    {
        $this->setPageTitle('Orders', 'View Order');
        $orderDetails =  $this->orderRepository->orderDetails($id);

        //dd($orderDetails->toArray());
        return view('admin.orders.view', compact('orderDetails'));
    }

    public function status($id, $status)
    {
        $this->setPageTitle('Orders', 'Action Order');

        //ORDER CANCEL
        if($status == 'cancel'){
            Order::where('id', $id)->update(
                ['order_status' => 'canceled']
            );

            return $this->responseRedirect('orders.index', trans('common.cancel_success'), 'success', false, false);
        }

        //ORDER DELETE
        else if($status == 'delete'){
            DB::beginTransaction();

            try {
                //DELETE ORDER DETAILS
                OrderDetail::where('order_id', $id)->delete();

                //DELETE PINT
                Point::where('order_id', $id)->delete();

                //DELETE ORDER
                Order::where('id', $id)->delete();

                DB::commit();

            } catch (ModelNotFoundException $e) {
                DB::rollback();
                throw new ModelNotFoundException($e);
            }

            return $this->responseRedirect('orders.index', trans('common.delete_success'), 'success', false, false);
        }

        else{
            redirect()->route('orders.index');
        }
    }
}
