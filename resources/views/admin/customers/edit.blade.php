@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> customer {{ trans('common.create')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}"
                               class="btn btn-primary"><i class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $customer->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{$customer->id}}">

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

                                    <!--- dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="dob" class="font-bold">{{ trans('customer.dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="dob" name="dob" value="{{ old('dob',$customer->customerProfile->dob) }}" placeholder="{{ trans('customer.dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- spouse dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="spouse_dob" class="font-bold">{{ trans('customer.spouse_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="spouse_dob" name="spouse_dob" value="{{ old('spouse_dob',$customer->customerProfile->spouse_dob) }}" placeholder="{{ trans('customer.spouse_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('spouse_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- father dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="father_dob" class="font-bold">{{ trans('customer.father_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="father_dob" name="father_dob" value="{{ old('father_dob',$customer->customerProfile->father_dob) }}" placeholder="{{ trans('customer.father_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('father_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- mother dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="mother_dob" class="font-bold">{{ trans('customer.mother_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="mother_dob" name="mother_dob" value="{{ old('mother_dob',$customer->customerProfile->mother_dob) }}" placeholder="{{ trans('customer.mother_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('mother_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- anniversary --->
                                    <div class="form-group" id="dateItem">
                                        <label for="anniversary" class="font-bold">{{ trans('customer.anniversary')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="anniversary" name="anniversary" value="{{ old('anniversary',$customer->customerProfile->anniversary) }}" placeholder="{{ trans('customer.anniversary')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('anniversary') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- first child dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="first_child_dob" class="font-bold">{{ trans('customer.first_child_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="first_child_dob" name="first_child_dob" value="{{ old('first_child_dob',$customer->customerProfile->first_child_dob) }}" placeholder="{{ trans('customer.first_child_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('first_child_dob') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!--- second child dob --->
                                    <div class="form-group" id="dateItem">
                                        <label for="second_child_dob" class="font-bold">{{ trans('customer.second_child_dob')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="second_child_dob" name="second_child_dob" value="{{ old('second_child_dob',$customer->customerProfile->second_child_dob) }}" placeholder="{{ trans('customer.second_child_dob')}}" class="form-control datepicker" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('second_child_dob') {{ $message }} @enderror </span>
                                    </div>

                                    <!---address--->
                                    <div class="form-group">
                                        <label for="address" class="font-bold">{{ trans('customer.address')}}</label>
                                        <textarea name="address"
                                                  placeholder="{{ trans('customer.address')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('address',$customer->customerProfile->address) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
                                    </div>

                                    <!---short biography--->
                                    <div class="form-group">
                                        <label for="short_biography" class="font-bold">{{ trans('customer.short_biography')}}</label>
                                        <textarea name="short_biography"
                                                  placeholder="{{ trans('customer.short_biography')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('short_biography',$customer->customerProfile->short_biography) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('short_biography') {{ $message }} @enderror </span>
                                    </div>

                                    <!---notification--->
                                    <div class="form-group">
                                        <label for="notification">{{ trans('customer.notification')}}</label>
                                        <select id="notification" class="form-control custom-select mt-15" name="notification" required>
                                            <option value="">{{ trans('customer.notification')}}</option>
                                            @foreach($notifications as $key => $notification)
                                                @if (old('notification',$customer->customerSetting->notification) == $key)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($notification) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($notification) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('notification') {{ $message }} @enderror </span>
                                    </div>

                                    <!---sms--->
                                    <div class="form-group">
                                        <label for="sms">{{ trans('customer.sms')}}</label>
                                        <select id="sms" class="form-control custom-select mt-15" name="sms" required>
                                            <option value="">{{ trans('customer.sms')}}</option>
                                            @foreach($smses as $key => $sms)
                                                @if (old('sms',$customer->customerSetting->sms) == $key)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($sms) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($sms) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('sms') {{ $message }} @enderror </span>
                                    </div>

                                    <!---offer_and_promotion--->
                                    <div class="form-group">
                                        <label for="offer_and_promotion">{{ trans('customer.offer_and_promotion')}}</label>
                                        <select id="offer_and_promotion" class="form-control custom-select mt-15" name="offer_and_promotion" required>
                                            <option value="">{{ trans('customer.offer_and_promotion')}}</option>
                                            @foreach($offerAndPromotions as $key => $offerAndPromotion)
                                                @if (old('offer_and_promotion', $customer->customerSetting->offer_and_promotion) == $key)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($offerAndPromotion) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($offerAndPromotion) }} </option>
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
