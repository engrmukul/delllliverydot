@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

<style>
    .ibox .label {
        font-size: 12px !important;
    }
</style>

@section('content')
    @include('admin.partials.flash')

    <div class="wrapper wrapper-content text-center">
        <div class="row h6">

            <div class="col-md-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Order list</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Restaurant</th>
                                <th>Rider</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><small>Order Placed</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small class="label-warning">Processing</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small class="label-success">Delivered</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small>Order Placed</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small class="label-warning">Processing</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small class="label-success">Delivered</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small>Order Placed</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small class="label-warning">Processing</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>
                            <tr>
                                <td><small class="label-success">Delivered</small></td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                                <td>+8801734183130</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Registered</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table class="table table-hover no-margins">
                            <thead>
                            <tr>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            <tr>
                                <td>+8801734183130</td>
                                <td>Customer</td>
                                <td> 2021-01-22</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="widget lazur-bg p-xl">

                    <div class="m-b-md">
                        <h1 class="m-xs">{{ $totalRestaurants }}</h1>
                        <h3 class="font-bold no-margins">
                            Total Restaurant
                        </h3>
                    </div>

                </div>
                <div class="widget red-bg p-lg text-center">
                    <div class="m-b-md">

                        <h1 class="m-xs">{{ $totalCustomers }}</h1>
                        <h3 class="font-bold no-margins">
                            Total Customer
                        </h3>
                    </div>
                </div>

                <div class="widget lazur-bg p-xl">

                    <div class="m-b-md">

                        <h1 class="m-xs">{{ $totalRiders }}</h1>
                        <h3 class="font-bold no-margins">
                            Total Riders
                        </h3>
                    </div>

                </div>
                <div class="widget red-bg p-lg text-center">
                    <div class="m-b-md">

                        <h1 class="m-xs">{{ $totalOrders }}</h1>
                        <h3 class="font-bold no-margins">
                            Total Orders
                        </h3>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
