<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Requests\OrderUpdateFormRequest;

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
     * @param Request $request
     * @return mixed
     */
    public function requestedGetData(Request $request)
    {
        return $this->orderRepository->requestedOrder($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('orders', 'orders List');
        $data = [
            'tableHeads' => [
                trans('order.SN'),
                trans('order.name'),
                trans('order.email'),
                trans('order.phone_number'),
                trans('order.isVerified'),
                trans('order.status'),
                trans('order.action')
            ],
            'dataUrl' => 'admin/orders/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone_number', 'name' => 'phone_number'],
                ['data' => 'isVerified', 'name' => 'isVerified'],
                ['data' => 'status', 'name' => 'status'],
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
        return $this->orderRepository->allOrders($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('orders', 'create order');

        $deliveryTypes = array(
            'home' => 'home',
            'collect' => 'collect',
        );

        $closedOrders = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $availableForDeliveries = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $notifications = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $popupNotifications = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $smses = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        $offerAndPromotions = array(
            '0' => 'No',
            '1' => 'Yes',
        );

        return view('admin.orders.create', compact('deliveryTypes','closedOrders','availableForDeliveries','notifications','popupNotifications','smses','offerAndPromotions'));

    }

    /**
     * @param StoreOrderFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderStoreFormRequest $request)
    {
        $params = $request->except('_token');

        if ($request->file('image') != null){

            $params['image'] = $this->saveImages($request->file('image'), 'img/order/', 500, 500);
        }

        $order = $this->orderRepository->createOrderByAdmin($params);

        if (!$order) {
            return $this->responseRedirectBack(trans('common.create_error'), 'error', true, true);
        }
        return $this->responseRedirect('orders.index', trans('common.create_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->setPageTitle('orders', 'Edit Order');

        $order = $this->orderRepository->findOrderById($id);

        return view('admin.orders.edit', compact('order'));
    }

    /**
     * @param UpdateOrderFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderUpdateFormRequest $request, Order $OrderModel)
    {
        $params = $request->except('_token');

        if ($request->has('image')) {

            $params['image'] = $this->saveImages($request->file('image'), 'img/order/', 500, 500);
        }

        $order = $this->orderRepository->updateOrder($params);

        if (!$order) {
            return $this->responseRedirectBack(trans('common.update_error'), 'error', true, true);
        }
        return $this->responseRedirect('orders.index', trans('common.update_success'), 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $params = $request->except('_token');
        $order = $this->orderRepository->deleteOrder($id, $params);

        if (!$order) {
            return $this->responseRedirectBack(trans('common.delete_error'), 'error', true, true);
        }
        return $this->responseRedirect('orders.index', trans('common.delete_success'), 'success', false, false);
    }
}
