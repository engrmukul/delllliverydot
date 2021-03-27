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
                                    <td>: {{isset($orderDetails->total_price) ? $orderDetails->total_price : "NA"}}</td>
                                </tr>

                                <tr>
                                    <td>Discount</td>
                                    <td>: {{isset($orderDetails->discount) ? $orderDetails->discount : "NA"}}</td>
                                </tr>

                                <tr>
                                    <td>VAT</td>
                                    <td>: {{isset($orderDetails->vat) ? $orderDetails->vat : "NA"}}</td>
                                </tr>

                                <tr>
                                    <td>Delivery Fee</td>
                                    <td>: {{isset($orderDetails->delivery_fee) ? $orderDetails->delivery_fee : "NA"}}</td>
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
                                @forelse($orderDetails->orderDetails as $od)

                                    <tr>
                                        <td>: {{isset($od->food_variants->name) ? $od->food_variants->name : "NA"}}</td>
                                        <td>: {{isset($od->food_variants->price) ? $od->food_variants->price : "NA"}}</td>
                                    </tr>

                                @empty
                                @endforelse

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
