@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/60riders32.png')}}" width="36" height="36" /> Customer Detail</h1>
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
                                    <td>: {{isset($customerDetails->name) ? $customerDetails->name : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{isset($customerDetails->email) ? $customerDetails->email : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>: {{isset($customerDetails->phone_number) ? $customerDetails->phone_number : "NA"}}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    @if(isset($customerDetails->customer_profile->image))
                                        <td>: <img width="50" src="{{$customerDetails->customer_profile->image}}" alt=""></td>
                                    @else
                                        <td>: NA</td>
                                    @endif

                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>: {{isset($customerDetails->customer_profile->address) ? $customerDetails->customer_profile->address : "NA"}}</td>
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
