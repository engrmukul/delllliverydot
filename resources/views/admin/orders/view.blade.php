@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/60riders32.png')}}" width="36" height="36" /> Order Detail</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <a class="backToList" href="{{ url()->previous() }}"><i class="fa fa-angle-left"></i> Back to {{ trans('common.go_back')}}</a>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <table class="table table-striped">

                                <tbody>
                                <tr>
                                    <td>Delivery Address</td>
                                    <td>: {{isset($orderDetails->delivery_address) ? $orderDetails->delivery_address : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td>: {{isset($orderDetails->order_date) ? $orderDetails->order_date : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Order Status</td>
                                    <td>: {{isset($orderDetails->order_status) ? $orderDetails->order_status : "NA"}}</td>
                                </tr>

                                <tr>
                                    <td>Payment Method</td>
                                    <td>: {{isset($orderDetails->payment_method) ? $orderDetails->payment_method : "NA"}}</td>
                                </tr>

                                <tr>
                                    <td>Total Price</td>
                                    <td>: {{isset($orderDetails->total_price) ? $orderDetails->total_price : "NA"}} <span class="currency_symbol">(&#2547;)</span></td>
                                </tr>

                                <tr>
                                    <td>Discount</td>
                                    <td>: {{isset($orderDetails->discount) ? $orderDetails->discount : "NA"}} <span class="currency_symbol">(&#2547;)</span></td>
                                </tr>

                                <tr>
                                    <td>VAT</td>
                                    <td>: {{isset($orderDetails->vat) ? $orderDetails->vat : "NA"}} <span class="currency_symbol">(&#2547;)</span></td>
                                </tr>

                                <tr>
                                    <td>Delivery Fee</td>
                                    <td>: {{isset($orderDetails->delivery_fee) ? $orderDetails->delivery_fee : "NA"}} <span class="currency_symbol">(&#2547;)</span></td>
                                </tr>

                                <tr>
                                    <td>Instructions</td>
                                    <td>: {{isset($orderDetails->instructions) ? $orderDetails->instructions : "NA"}}</td>
                                </tr>

                                <tr>
                                    <td>Coupon Code</td>
                                    <td>: {{isset($orderDetails->coupon_code) ? $orderDetails->coupon_code : "NA"}}</td>
                                </tr>

                                <hr>

                                <h3>Order Food Details</h3>
                                <tr>
                                    <td><strong>Food Items</strong></td>
                                    <td>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Food</th>
                                                <th scope="col">Qty</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($orderDetails->orderDetails as $key => $od)

                                                    @forelse($od->foodVariants as $food)
                                                            <tr>
                                                                <th scope="row">{{$key+1}}</th>
                                                                <td>{{$food->name}}</td>
                                                                <td>{{$od->food_quantity}}</td>
                                                            </tr>
                                                    @empty
                                                    @endforelse

                                                @empty
                                                @endforelse


                                            </tbody>
                                        </table>
                                    </td>

                                </tr>

                                <hr>
                                <tr>
                                    <td>Customer</td>
                                    <td>: {{isset($orderDetails->customer->name) ? $orderDetails->customer->name : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Restaurant</td>
                                    <td>: {{isset($orderDetails->restaurant->name) ? $orderDetails->restaurant->name : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Rider</td>
                                    <td>: {{isset($orderDetails->rider->name) ? $orderDetails->rider->name : "NA"}}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
