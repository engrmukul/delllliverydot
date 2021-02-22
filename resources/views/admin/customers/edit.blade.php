@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/70customers32.png')}}" width="36" height="36" /> Edit Customer Data</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <a class="backToList" href="{{route( strtolower($pageTitle) . '.index')}}"><i class="fa fa-angle-left"></i> Back to {{ trans('common.go_back')}}</a>
                    </div>
                    <div class="ibox-content">

                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $customer->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="customer_id" value="{{$customer->id}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <!---name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('customer.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name',$customer->name) }}" placeholder="{{ trans('customer.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!---email--->
                                    <div class="form-group">
                                        <label for="email" class="font-bold">{{ trans('customer.email')}}</label>
                                        <input type="text" name="email" value="{{ old('email',$customer->email) }}" placeholder="{{ trans('customer.email')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('email') {{ $message }} @enderror </span>
                                    </div>

                                    <!---phone number--->
                                    <div class="form-group">
                                        <label for="phone_number" class="font-bold">{{ trans('customer.phone_number')}}</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number',$customer->phone_number) }}" placeholder="{{ trans('customer.phone_number')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('phone_number') {{ $message }} @enderror </span>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <!---address--->
                                    <div class="form-group">
                                        <label for="address" class="font-bold">{{ trans('customer.address')}}</label>
                                        <textarea name="address"
                                                  placeholder="{{ trans('customer.address')}}"
                                                  class="form-control"
                                                  required>{{ old('address',$customer->customerProfile->address) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="dob" class="font-bold">{{ trans('customer.dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="dob" name="dob" value="{{ old('dob',$customer->customerProfile->dob) }}" placeholder="{{ trans('customer.dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('dob') {{ $message }} @enderror </span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!---CONTROL BUTTON--->
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Complete Editing</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
