<?php

namespace App\Http\Controllers\API\V1;

use App\Contracts\OrderContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends BaseController
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $params = $request->except('_token');

        $orders = $this->orderRepository->listOrder($params);

        return $this->sendResponse($orders, 'Order retrieved successfully.',Response::HTTP_OK);
    }
}
