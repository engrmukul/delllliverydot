@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/50coupons32.png')}}" width="36" height="36" /> Coupons</h1>
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
                            <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">

                                        <!---coupon type--->
                                        <div class="form-group">
                                            <label for="coupon_type">{{ trans('coupon.coupon_type')}}</label>
                                            <select id="coupon_type" class="form-control custom-select mt-15" name="coupon_type" required>
                                                <option value="">{{ trans('coupon.coupon_type')}}</option>
                                                @foreach($couponTypes as $key => $couponType)
                                                    @if (old('coupon_type') == $couponType)
                                                        <option value="{{ $couponType }}" selected> {{ ucfirst($couponType) }} </option>
                                                    @else
                                                        <option value="{{ $couponType }}"> {{ ucfirst($couponType) }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="form-text m-b-none text-danger"> @error('coupon_type') {{ $message }} @enderror </span>
                                        </div>

                                        <!---coupon code--->
                                        <div class="form-group">
                                            <label for="code" class="font-bold">{{ trans('coupon.code')}}</label>
                                            <input type="text" name="code" value="{{ old('code') }}" placeholder="{{ trans('coupon.code')}}" class="form-control" required>
                                            <span class="form-text m-b-none text-danger"> @error('code') {{ $message }} @enderror </span>
                                        </div>

                                        <!---total code--->
                                        <div class="form-group">
                                            <label for="total_code" class="font-bold">{{ trans('coupon.total_code')}}</label>
                                            <input type="text" name="total_code" value="{{ old('total_code') }}" placeholder="{{ trans('coupon.total_code')}}" class="form-control" required>
                                            <span class="form-text m-b-none text-danger"> @error('total_code') {{ $message }} @enderror </span>
                                        </div>

                                        <!---discount type--->
                                        <div class="form-group">
                                            <label for="discount_type">{{ trans('coupon.discount_type')}}</label>
                                            <select id="discount_type" class="form-control custom-select mt-15" name="discount_type" required>
                                                <option value="">{{ trans('coupon.discount_type')}}</option>
                                                @foreach($discountTypes as $key => $discountType)
                                                    @if (old('discount_type') == $discountType)
                                                        <option value="{{ $discountType }}" selected> {{ ucfirst($discountType) }} </option>
                                                    @else
                                                        <option value="{{ $discountType }}"> {{ ucfirst($discountType) }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="form-text m-b-none text-danger"> @error('discount_type') {{ $message }} @enderror </span>
                                        </div>

                                        <!---discount--->
                                        <div class="form-group">
                                            <label for="discount" class="font-bold">{{ trans('coupon.discount')}}<span class="currency_symbol">(&#2547;)</span></label>
                                            <input type="text" name="discount" value="{{ old('discount') }}" placeholder="{{ trans('coupon.discount')}}" class="form-control" required>
                                            <span class="form-text m-b-none text-danger"> @error('discount') {{ $message }} @enderror </span>
                                        </div>

                                        <!---minimum_order--->
                                        <div class="form-group">
                                            <label for="minimum_order" class="font-bold">{{ trans('coupon.minimum_order')}}<span class="currency_symbol">(&#2547;)</span></label>
                                            <input type="text" name="minimum_order" value="{{ old('minimum_order') }}" placeholder="{{ trans('coupon.minimum_order')}}" class="form-control">
                                            <span class="form-text m-b-none text-danger"> @error('minimum_order') {{ $message }} @enderror </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <!---description--->
                                        <div class="form-group">
                                            <label for="description" class="font-bold">{{ trans('coupon.description')}}</label>
                                            <textarea name="description"
                                                      placeholder="{{ trans('coupon.description')}}"
                                                      class="form-control"
                                                      required>{{ old('description') }}</textarea>
                                            <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                                        </div>

                                        <!--- restaurant id --->
                                        <div class="form-group restaurantCoupon">
                                            <label for="restaurant_id">{{ trans('coupon.restaurant_id')}} <small>Hold <span>Ctrl/Command</span> key to select multiple</small></label>
                                            <select id="restaurant_id" multiple class="form-control custom-select mt-15 multiple" name="restaurant_id[]">
                                                {{-- <option value="">{{ trans('coupon.restaurant_id')}}</option> --}}
                                                @foreach($restaurants as $key => $restaurant)
                                                    @if (old('restaurant_id') == $restaurant->id)
                                                        <option value="{{ $restaurant->id }}" selected> {{ $restaurant->name }} </option>
                                                    @else
                                                        <option value="{{ $restaurant->id }}"> {{ $restaurant->name }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="form-text m-b-none text-danger"> @error('restaurant_id') {{ $message }} @enderror </span>
                                        </div>

                                        <!--- start date --->
                                        <div class="form-group" id="dateItem">
                                            <label for="start_date" class="font-bold">{{ trans('coupon.start_date')}}</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="start_date" name="start_date" autocomplete="off" value="{{ old('start_date') }}" placeholder="{{ trans('coupon.start_date')}}" class="form-control datepicker" required>
                                            </div>
                                            <span class="form-text m-b-none text-danger"> @error('start_date') {{ $message }} @enderror </span>
                                        </div>

                                        <!--- expire datate --->
                                        <div class="form-group" id="dateItem">
                                            <label for="expire_at" class="font-bold">{{ trans('coupon.expire_at')}}</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="expire_at" name="expire_at" autocomplete="off" value="{{ old('expire_at') }}" placeholder="{{ trans('coupon.expire_at')}}" class="form-control datepicker" required>
                                            </div>
                                            <span class="form-text m-b-none text-danger"> @error('expire_at') {{ $message }} @enderror </span>
                                        </div>
                                  </div>
                             </div>
                            <div class="row">
                               <div class="col-12">
                                   <!---CONTROL BUTTON--->
                                   <div class="form-group">
                                       <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Create Coupon</button>
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

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#restaurant_id').select2({
                placeholder: 'Select restaurant',
                allowClear: true
            });

            $('.restaurantCoupon').show();

            $('#coupon_type').on('change', function (){
                if($(this).val() == 'general' ){
                    $('.restaurantCoupon').hide();
                    $('#restaurant_id').select2('val',$('#restaurant_id').find('option:selected').val())
                }else{
                    $('.restaurantCoupon').show();
                }
            })

        });
    </script>
@endpush
