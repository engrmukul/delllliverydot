@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> rider {{ trans('common.create')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}"
                               class="btn btn-primary"><i class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $rider->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="rider_id" value="{{ $rider->id }}">
                            <input type="hidden" name="password" value="123456">

                            <div class="row">
                                <div class="col-md-6">
                                    <!---name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('rider.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name', $rider->name) }}" placeholder="{{ trans('rider.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!---email--->
                                    <div class="form-group">
                                        <label for="email" class="font-bold">{{ trans('rider.email')}}</label>
                                        <input type="text" name="email" value="{{ old('email', $rider->email) }}" placeholder="{{ trans('rider.email')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('email') {{ $message }} @enderror </span>
                                    </div>

                                    <!---phone number--->
                                    <div class="form-group">
                                        <label for="phone_number" class="font-bold">{{ trans('rider.phone_number')}}</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', $rider->phone_number) }}" placeholder="{{ trans('rider.phone_number')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('phone_number') {{ $message }} @enderror </span>
                                    </div>

                                    <!---NID--->
                                    <div class="form-group">
                                        <label for="nid" class="font-bold">{{ trans('rider.nid')}}</label>
                                        <input type="text" name="nid" value="{{ old('nid', $rider->nid) }}" placeholder="{{ trans('rider.nid')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('nid') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!---address--->
                                    <div class="form-group">
                                        <label for="address" class="font-bold">{{ trans('rider.address')}}</label>
                                        <textarea name="address"
                                                  placeholder="{{ trans('rider.address')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('address', $rider->riderProfile->address) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="dob" class="font-bold">{{ trans('rider.dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="dob" name="dob" value="{{ old('dob', $rider->riderProfile->dob) }}" placeholder="{{ trans('rider.dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('dob') {{ $message }} @enderror </span>
                                    </div>
                                    <!---Image--->
                                    <div class="form-group">
                                        <label for="image" class="font-bold">{{ trans('rider.image')}}</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('image') {{ $message }} @enderror </span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">

                                    <!---CONTROL BUTTON--->
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('common.submit')}}</button>
                                        <a class="btn btn-danger" href="{{route( strtolower($pageTitle) . '.index')}}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>{{ trans('common.go_back')}}</a>
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
