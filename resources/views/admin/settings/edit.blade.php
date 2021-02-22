@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/90settings32.png')}}" width="36" height="36" /> Settings</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> {{ $pageTitle }} Update Form</h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">
                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update' )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <h1>Firebase Cloud Messaging</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="SERVER_API_KEY" class="font-bold">{{ trans('SERVER_API_KEY')}}</label>
                                        <textarea name="SERVER_API_KEY" placeholder="{{ trans('SERVER_API_KEY')}}" class="form-control" required>{{ old('SERVER_API_KEY', $FCM->SERVER_API_KEY) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('SERVER_API_KEY') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <hr><h1>PUSHER</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="PUSHER_APP_ID" class="font-bold">{{ trans('PUSHER_APP_ID')}}</label>
                                        <input type="text" name="PUSHER_APP_ID" value="{{ old('PUSHER_APP_ID', $PUSHER->PUSHER_APP_ID) }}" placeholder="{{ trans('PUSHER_APP_ID')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('PUSHER_APP_ID') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="PUSHER_APP_KEY" class="font-bold">{{ trans('PUSHER_APP_KEY')}}</label>
                                        <input type="text" name="PUSHER_APP_KEY" value="{{ old('PUSHER_APP_KEY', $PUSHER->PUSHER_APP_KEY) }}" placeholder="{{ trans('PUSHER_APP_KEY')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('PUSHER_APP_KEY') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="PUSHER_APP_SECRET" class="font-bold">{{ trans('PUSHER_APP_SECRET')}}</label>
                                        <input type="text" name="PUSHER_APP_SECRET" value="{{ old('PUSHER_APP_SECRET', $PUSHER->PUSHER_APP_SECRET) }}" placeholder="{{ trans('PUSHER_APP_SECRET')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('PUSHER_APP_SECRET') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="PUSHER_APP_CLUSTER" class="font-bold">{{ trans('PUSHER_APP_CLUSTER')}}</label>
                                        <input type="text" name="PUSHER_APP_CLUSTER" value="{{ old('PUSHER_APP_CLUSTER', $PUSHER->PUSHER_APP_CLUSTER) }}" placeholder="{{ trans('PUSHER_APP_CLUSTER')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('PUSHER_APP_CLUSTER') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <hr><h1>TWILIO</h1>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="TWILIO_SID" class="font-bold">{{ trans('TWILIO_SID')}}</label>
                                        <input type="text" name="TWILIO_SID" value="{{ old('TWILIO_SID', $TWILIO->TWILIO_SID) }}" placeholder="{{ trans('TWILIO_SID')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('TWILIO_SID') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="TWILIO_AUTH_TOKEN" class="font-bold">{{ trans('TWILIO_AUTH_TOKEN')}}</label>
                                        <input type="text" name="TWILIO_AUTH_TOKEN" value="{{ old('TWILIO_AUTH_TOKEN', $TWILIO->TWILIO_AUTH_TOKEN) }}" placeholder="{{ trans('TWILIO_AUTH_TOKEN')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('TWILIO_AUTH_TOKEN') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="TWILIO_VERIFY_SID" class="font-bold">{{ trans('TWILIO_VERIFY_SID')}}</label>
                                        <input type="text" name="TWILIO_VERIFY_SID" value="{{ old('TWILIO_VERIFY_SID', $TWILIO->TWILIO_VERIFY_SID) }}" placeholder="{{ trans('TWILIO_VERIFY_SID')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('TWILIO_VERIFY_SID') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!---CONTROL BUTTON--->
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('common.update')}}</button>
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
