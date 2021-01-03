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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <!---name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('rider.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('rider.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!---email--->
                                    <div class="form-group">
                                        <label for="email" class="font-bold">{{ trans('rider.email')}}</label>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="{{ trans('rider.email')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('email') {{ $message }} @enderror </span>
                                    </div>

                                    <!---phone number--->
                                    <div class="form-group">
                                        <label for="phone_number" class="font-bold">{{ trans('rider.phone_number')}}</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="{{ trans('rider.phone_number')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('phone_number') {{ $message }} @enderror </span>
                                    </div>

                                    <!---NID--->
                                    <div class="form-group">
                                        <label for="nid" class="font-bold">{{ trans('rider.nid')}}</label>
                                        <input type="text" name="nid" value="{{ old('nid') }}" placeholder="{{ trans('rider.nid')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('nid') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Image--->
                                    <div class="form-group">
                                        <label for="image" class="font-bold">{{ trans('rider.image')}}</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('image') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="dob" class="font-bold">{{ trans('rider.dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="dob" name="dob" value="{{ old('dob') }}" placeholder="{{ trans('rider.dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- spouse dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="spouse_dob" class="font-bold">{{ trans('rider.spouse_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="spouse_dob" name="spouse_dob" value="{{ old('spouse_dob') }}" placeholder="{{ trans('rider.spouse_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('spouse_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- father dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="father_dob" class="font-bold">{{ trans('rider.father_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="father_dob" name="father_dob" value="{{ old('father_dob') }}" placeholder="{{ trans('rider.father_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('father_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- mother dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="mother_dob" class="font-bold">{{ trans('rider.mother_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="mother_dob" name="mother_dob" value="{{ old('mother_dob') }}" placeholder="{{ trans('rider.mother_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('mother_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- anniversary --->
                                    <div class="form-group" id="dateItem">
                                        <label for="anniversary" class="font-bold">{{ trans('rider.anniversary')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="anniversary" name="anniversary" value="{{ old('anniversary') }}" placeholder="{{ trans('rider.anniversary')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('anniversary') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- first child dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="first_child_dob" class="font-bold">{{ trans('rider.first_child_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="first_child_dob" name="first_child_dob" value="{{ old('first_child_dob') }}" placeholder="{{ trans('rider.first_child_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('first_child_dob') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!--- second child dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="second_child_dob" class="font-bold">{{ trans('rider.second_child_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="second_child_dob" name="second_child_dob" value="{{ old('second_child_dob') }}" placeholder="{{ trans('rider.second_child_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('second_child_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!---address--->
                                    <div class="form-group">
                                        <label for="address" class="font-bold">{{ trans('rider.address')}}</label>
                                        <textarea name="address"
                                                  placeholder="{{ trans('rider.address')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('address') }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
                                    </div>

                                    <!---is current address--->
                                    <div class="form-group">
                                        <label for="is_current_address">{{ trans('rider.is_current_address')}}</label>
                                        <select id="is_current_address" class="form-control custom-select mt-15" name="is_current_address" required>
                                            <option value="">{{ trans('rider.is_current_address')}}</option>
                                            @foreach($currentAddresses as $key => $currentAddresse)
                                                @if (old('is_current_address') == $currentAddresse)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($currentAddresse) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($currentAddresse) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('is_current_address') {{ $message }} @enderror </span>
                                    </div>

                                    <!---short biography--->
                                    <div class="form-group">
                                        <label for="short_biography" class="font-bold">{{ trans('rider.short_biography')}}</label>
                                        <textarea name="short_biography"
                                                  placeholder="{{ trans('rider.short_biography')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('short_biography') }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('short_biography') {{ $message }} @enderror </span>
                                    </div>

                                    <!---notification--->
                                    <div class="form-group">
                                        <label for="notification">{{ trans('rider.notification')}}</label>
                                        <select id="notification" class="form-control custom-select mt-15" name="notification" required>
                                            <option value="">{{ trans('rider.notification')}}</option>
                                            @foreach($notifications as $key => $notification)
                                                @if (old('notification') == $notification)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($notification) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($notification) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('notification') {{ $message }} @enderror </span>
                                    </div>

                                    <!---popup_notification--->
                                    <div class="form-group">
                                        <label for="popup_notification">{{ trans('rider.popup_notification')}}</label>
                                        <select id="popup_notification" class="form-control custom-select mt-15" name="popup_notification" required>
                                            <option value="">{{ trans('rider.popup_notification')}}</option>
                                            @foreach($popupNotifications as $key => $popupNotification)
                                                @if (old('popup_notification') == $popupNotification)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($popupNotification) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($popupNotification) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('popup_notification') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- order id --->
                                    <div class="form-group">
                                        <label for="order_id">{{ trans('rider.order_id')}}</label>
                                        <select id="order_id" class="form-control custom-select mt-15" name="order_id" required>
                                            <option value="">{{ trans('rider.order_id')}}</option>
                                            @foreach($orders as $key => $order)
                                                @if (old('order_id') == $order->id)
                                                    <option value="{{ $order->id }}" selected> {{ $order->name }} </option>
                                                @else
                                                    <option value="{{ $order->id }}"> {{ $order->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('order_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- ride date --->
                                    <div class="form-group" id="dateItem">
                                        <label for="ride_date" class="font-bold">{{ trans('rider.ride_date')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="ride_date" name="ride_date" value="{{ old('ride_date') }}" placeholder="{{ trans('rider.ride_date')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('ride_date') {{ $message }} @enderror </span>
                                    </div>

                                    <!---sms--->
                                    <div class="form-group">
                                        <label for="sms">{{ trans('rider.sms')}}</label>
                                        <select id="sms" class="form-control custom-select mt-15" name="sms" required>
                                            <option value="">{{ trans('rider.sms')}}</option>
                                            @foreach($smses as $key => $sms)
                                                @if (old('sms') == $sms)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($sms) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($sms) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('sms') {{ $message }} @enderror </span>
                                    </div>

                                    <!---offer and promotion--->
                                    <div class="form-group">
                                        <label for="offer_and_promotion">{{ trans('rider.offer_and_promotion')}}</label>
                                        <select id="offer_and_promotion" class="form-control custom-select mt-15" name="offer_and_promotion" required>
                                            <option value="">{{ trans('rider.offer_and_promotion')}}</option>
                                            @foreach($smses as $key => $sms)
                                                @if (old('offer_and_promotion') == $sms)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($sms) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($sms) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('offer_and_promotion') {{ $message }} @enderror </span>
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
