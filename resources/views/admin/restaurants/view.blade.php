@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/60riders32.png')}}" width="36" height="36" /> Restaturant Detail</h1>
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
                                    <td>Name</td>
                                    <td>: {{isset($restaurantDetails->name) ? $restaurantDetails->name : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{isset($restaurantDetails->email) ? $restaurantDetails->email : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>: {{isset($restaurantDetails->phone_number) ? $restaurantDetails->phone_number : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    @if(isset($restaurantDetails->restaurant_profile->image))
                                        <td>: <img width="50" src="{{$restaurantDetails->restaurant_profile->image}}" alt=""></td>
                                    @else
                                        <td>: NA</td>
                                    @endif

                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>: {{isset($restaurantDetails->restaurant_profile->address) ? $restaurantDetails->restaurant_profile->address : "NA"}}</td>
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
