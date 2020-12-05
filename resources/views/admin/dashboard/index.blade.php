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
        <div class="row">
            <div class="col-lg-4">
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
            </div>
            <div class="col-lg-4">
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
            <div class="col-lg-4">
                <div class="widget lazur-bg p-xl">

                    <div class="m-b-md">

                        <h1 class="m-xs">47</h1>
                        <h3 class="font-bold no-margins">
                            Notification
                        </h3>
                    </div>

                </div>
                <div class="widget red-bg p-lg text-center">
                    <div class="m-b-md">
                        <h1 class="m-xs">47</h1>
                        <h3 class="font-bold no-margins">
                            Notification
                        </h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
