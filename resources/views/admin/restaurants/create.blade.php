@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> restaurant {{ trans('common.create')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}"
                               class="btn btn-primary"><i class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.store')}}" enctype="multipart/form-data">
                            @csrf

                            <!--RESTAURANT--->
                            <div class="row">
                                <div class="col-md-6">

                                    <!---Name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('restaurant.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('restaurant.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Email--->
                                    <div class="form-group">
                                        <label for="email" class="font-bold">{{ trans('restaurant.email')}}</label>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="{{ trans('restaurant.email')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('email') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Phone--->
                                    <div class="form-group">
                                        <label for="phone_number" class="font-bold">{{ trans('restaurant.phone_number')}}</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="{{ trans('restaurant.phone_number')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('phone_number') {{ $message }} @enderror </span>
                                    </div>

                                </div>
                            </div>

                            <!---RESTAURANT PROFILE--->
                            <div class="row">
                                <div class="col-md-6">

                                    <!---NID--->
                                    <div class="form-group">
                                        <label for="nid" class="font-bold">{{ trans('restaurant.nid')}}</label>
                                        <input type="text" name="nid" value="{{ old('nid') }}" placeholder="{{ trans('restaurant.nid')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('nid') {{ $message }} @enderror </span>
                                    </div>

                                    <!---trade_licence--->
                                    <div class="form-group">
                                        <label for="trade_licence" class="font-bold">{{ trans('restaurant.trade_licence')}}</label>
                                        <input type="text" name="trade_licence" value="{{ old('trade_licence') }}" placeholder="{{ trans('restaurant.trade_licence')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('trade_licence') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_type--->
                                    <div class="form-group">
                                        <label for="delivery_type">{{ trans('restaurant.delivery_type')}}</label>
                                        <select id="delivery_type" class="form-control custom-select mt-15" name="delivery_type" required>
                                            <option value="">{{ trans('restaurant.delivery_type')}}</option>
                                            @foreach($deliveryTypes as $key => $deliveryType)
                                                @if (old('delivery_type') == $deliveryType)
                                                    <option value="{{ $deliveryType }}" selected> {{ ucfirst($deliveryType) }} </option>
                                                @else
                                                    <option value="{{ $deliveryType }}"> {{ ucfirst($deliveryType) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_type') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_fee--->
                                    <div class="form-group">
                                        <label for="delivery_fee" class="font-bold">{{ trans('restaurant.delivery_fee')}}</label>
                                        <input type="text" name="delivery_fee" value="{{ old('delivery_fee') }}" placeholder="{{ trans('restaurant.delivery_fee')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_fee') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_time--->
                                    <div class="form-group">
                                        <label for="delivery_time" class="font-bold">{{ trans('restaurant.delivery_time')}}</label>
                                        <input type="text" name="delivery_time" value="{{ old('delivery_time') }}" placeholder="{{ trans('restaurant.delivery_time')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_time') {{ $message }} @enderror </span>
                                    </div>

                                    <!---discount--->
                                    <div class="form-group">
                                        <label for="discount" class="font-bold">{{ trans('restaurant.discount')}}</label>
                                        <input type="text" name="discount" value="{{ old('discount') }}" placeholder="{{ trans('restaurant.discount')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('discount') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_range--->
                                    <div class="form-group">
                                        <label for="delivery_range" class="font-bold">{{ trans('restaurant.delivery_range')}}</label>
                                        <input type="text" name="delivery_range" value="{{ old('delivery_range') }}" placeholder="{{ trans('restaurant.delivery_range')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_range') {{ $message }} @enderror </span>
                                    </div>

                                    <!---mobile--->
                                    <div class="form-group">
                                        <label for="mobile" class="font-bold">{{ trans('restaurant.mobile')}}</label>
                                        <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="{{ trans('restaurant.mobile')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('mobile') {{ $message }} @enderror </span>
                                    </div>

                                    <!---address--->
                                    <div class="form-group">
                                        <label for="address" class="font-bold">{{ trans('restaurant.address')}}</label>
                                        <input type="text" name="address" value="{{ old('address') }}" placeholder="{{ trans('restaurant.address')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
                                    </div>

                                    <!---latitude--->
                                    <div class="form-group">
                                        <label for="latitude" class="font-bold">{{ trans('restaurant.latitude')}}</label>
                                        <input type="text" name="latitude" value="{{ old('latitude') }}" placeholder="{{ trans('restaurant.latitude')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('latitude') {{ $message }} @enderror </span>
                                    </div>

                                    <!---longitude--->
                                    <div class="form-group">
                                        <label for="longitude" class="font-bold">{{ trans('restaurant.longitude')}}</label>
                                        <input type="text" name="longitude" value="{{ old('longitude') }}" placeholder="{{ trans('restaurant.longitude')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('longitude') {{ $message }} @enderror </span>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <!---closed_restaurant--->
                                    <div class="form-group">
                                        <label for="closed_restaurant">{{ trans('restaurant.closed_restaurant')}}</label>
                                        <select id="closed_restaurant" class="form-control custom-select mt-15" name="closed_restaurant" required>
                                            <option value="">{{ trans('restaurant.closed_restaurant')}}</option>
                                            @foreach($closedRestaurants as $key => $closedRestaurant)
                                                @if (old('closed_restaurant') == $closedRestaurant)
                                                    <option value="{{ $closedRestaurant }}" selected> {{ ucfirst($closedRestaurant) }} </option>
                                                @else
                                                    <option value="{{ $closedRestaurant }}"> {{ ucfirst($closedRestaurant) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_type') {{ $message }} @enderror </span>
                                    </div>

                                    <!---available_for_delivery--->
                                    <div class="form-group">
                                        <label for="available_for_delivery">{{ trans('restaurant.available_for_delivery')}}</label>
                                        <select id="available_for_delivery" class="form-control custom-select mt-15" name="available_for_delivery" required>
                                            <option value="">{{ trans('restaurant.available_for_delivery')}}</option>
                                            @foreach($availableForDeliveries as $key => $availableForDelivery)
                                                @if (old('available_for_delivery') == $availableForDelivery)
                                                    <option value="{{ $availableForDelivery }}" selected> {{ ucfirst($availableForDelivery) }} </option>
                                                @else
                                                    <option value="{{ $availableForDelivery }}"> {{ ucfirst($availableForDelivery) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_type') {{ $message }} @enderror </span>
                                    </div>

                                    <!---image--->
                                    <div class="form-group">
                                        <label for="images" class="font-bold">{{ trans('restaurant.image')}}</label>
                                        <input type="file" id="images" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('image') {{ $message }} @enderror </span>
                                    </div>

                                    <!---description--->
                                    <div class="form-group">
                                        <label for="description" class="font-bold">{{ trans('restaurant.description')}}</label>
                                        <textarea name="description"
                                                  placeholder="{{ trans('restaurant.description')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('description') }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                                    </div>

                                    <!---information--->
                                    <div class="form-group">
                                        <label for="short_description" class="font-bold">{{ trans('restaurant.information')}}</label>
                                        <textarea name="information"
                                                  placeholder="{{ trans('restaurant.information')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('information') }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('information') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <!---RESTAURANT SETTINGS--->
                            <div class="row">
                                <div class="col-md-6">

                                    <!---notification--->
                                    <div class="form-group">
                                        <label for="notification">{{ trans('restaurant.notification')}}</label>
                                        <select id="notification" class="form-control custom-select mt-15" name="notification" required>
                                            <option value="">{{ trans('restaurant.notification')}}</option>
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
                                        <label for="popup_notification">{{ trans('restaurant.popup_notification')}}</label>
                                        <select id="popup_notification" class="form-control custom-select mt-15" name="popup_notification" required>
                                            <option value="">{{ trans('restaurant.popup_notification')}}</option>
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

                                    <!---sms--->
                                    <div class="form-group">
                                        <label for="sms">{{ trans('restaurant.sms')}}</label>
                                        <select id="sms" class="form-control custom-select mt-15" name="sms" required>
                                            <option value="">{{ trans('restaurant.sms')}}</option>
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

                                    <!---offer_and_promotion--->
                                    <div class="form-group">
                                        <label for="offer_and_promotion">{{ trans('restaurant.offer_and_promotion')}}</label>
                                        <select id="offer_and_promotion" class="form-control custom-select mt-15" name="offer_and_promotion" required>
                                            <option value="">{{ trans('restaurant.offer_and_promotion')}}</option>
                                            @foreach($offerAndPromotions as $key => $offerAndPromotion)
                                                @if (old('offer_and_promotion') == $offerAndPromotion)
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
