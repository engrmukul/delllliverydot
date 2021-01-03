{{--@extends('admin.app')--}}
{{--@section('title') {{ $pageTitle }} @endsection--}}
{{--@section('content')--}}
{{--    @include('admin.partials.flash')--}}
{{--    <div class="wrapper wrapper-content animated fadeInRight">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="ibox ">--}}
{{--                    <div class="ibox-title">--}}
{{--                        <h5><i class="fa fa-book"></i> coupon {{ trans('common.create')}}</h5>--}}
{{--                        <div class="ibox-tools">--}}
{{--                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i--}}
{{--                                    class="fa fa-list"></i> {{ trans('common.list')}}</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="ibox-content">--}}

{{--                        <!---FORM--->--}}
{{--                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.store')}}" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <!---coupon code--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="code" class="font-bold">{{ trans('coupon.code')}}</label>--}}
{{--                                        <input type="text" name="code" value="{{ old('code') }}" placeholder="{{ trans('coupon.code')}}" class="form-control" required>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('code') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!---total code--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="total_code" class="font-bold">{{ trans('coupon.total_code')}}</label>--}}
{{--                                        <input type="text" name="total_code" value="{{ old('total_code') }}" placeholder="{{ trans('coupon.total_code')}}" class="form-control" required>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('total_code') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!---total used code--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="total_used_code" class="font-bold">{{ trans('coupon.total_used_code')}}</label>--}}
{{--                                        <input type="text" name="total_used_code" value="{{ old('total_code') }}" placeholder="{{ trans('coupon.total_used_code')}}" class="form-control" required>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('total_used_code') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!---discound tupe--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="discount_type">{{ trans('coupon.discount_type')}}</label>--}}
{{--                                        <select id="discount_type" class="form-control custom-select mt-15" name="discount_type" required>--}}
{{--                                            <option value="">{{ trans('coupon.discount_type')}}</option>--}}
{{--                                            @foreach($discountTypes as $key => $discountType)--}}
{{--                                                @if (old('discount_type',$coupon->food_id) == $discountType)--}}
{{--                                                    <option value="{{ $discountType }}" selected> {{ ucfirst($discountType) }} </option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{ $discountType }}"> {{ ucfirst($discountType) }} </option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('discount_type') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!---discount--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="discount" class="font-bold">{{ trans('coupon.discount')}}</label>--}}
{{--                                        <input type="text" name="discount" value="{{ old('discount') }}" placeholder="{{ trans('coupon.discount')}}" class="form-control" required>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('discount') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}

{{--                                    <!---description--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="description" class="font-bold">{{ trans('coupon.description')}}</label>--}}
{{--                                        <textarea name="description"--}}
{{--                                                  placeholder="{{ trans('coupon.description')}}"--}}
{{--                                                  class="form-control summernote"--}}
{{--                                                  required>{{ old('description') }}</textarea>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!--- food id --->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="food_id">{{ trans('coupon.food_id')}}</label>--}}
{{--                                        <input type="hidden" name="id" value="{{ $coupon->id }}">--}}
{{--                                        <select id="food_id" class="form-control custom-select mt-15" name="food_id" required>--}}
{{--                                            <option value="">{{ trans('coupon.food_id')}}</option>--}}
{{--                                            @foreach($foods as $key => $food)--}}
{{--                                                @if (old('food_id', $coupon->food_id) == $food->id)--}}
{{--                                                    <option value="{{ $food->id }}" selected> {{ $food->name }} </option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{ $food->id }}"> {{ $food->name }} </option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('food_id') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!--- restaurant id --->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="restaurant_id">{{ trans('coupon.restaurant_id')}}</label>--}}
{{--                                        <input type="hidden" name="id" value="{{ $coupon->id }}">--}}
{{--                                        <select id="restaurant_id" class="form-control custom-select mt-15" name="restaurant_id" required>--}}
{{--                                            <option value="">{{ trans('coupon.restaurant_id')}}</option>--}}
{{--                                            @foreach($restaurants as $key => $restaurant)--}}
{{--                                                @if (old('restaurant_id', $coupon->food_id) == $restaurant->id)--}}
{{--                                                    <option value="{{ $restaurant->id }}" selected> {{ $restaurant->name }} </option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{ $restaurant->id }}"> {{ $restaurant->name }} </option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('restaurant_id') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!--- category id --->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="category_id">{{ trans('coupon.category_id')}}</label>--}}
{{--                                        <input type="hidden" name="id" value="{{ $coupon->id }}">--}}
{{--                                        <select id="category_id" class="form-control custom-select mt-15" name="category_id" required>--}}
{{--                                            <option value="">{{ trans('coupon.category_id')}}</option>--}}
{{--                                            @foreach($categories as $key => $category)--}}
{{--                                                @if (old('category_id', $coupon->category_id) == $category->id)--}}
{{--                                                    <option value="{{ $category->id }}" selected> {{ $category->name }} </option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('category_id') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}

{{--                                    <!--- expire datate --->--}}
{{--                                    <div class="form-group" id="dateItem">--}}
{{--                                        <label for="expire_at" class="font-bold">{{ trans('coupon.expire_at')}}</label>--}}
{{--                                        <div class="input-group date">--}}
{{--                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>--}}
{{--                                            <input type="text" id="expire_at" name="expire_at" value="{{ old('expire_at') }}" placeholder="{{ trans('coupon.expire_at')}}" class="form-control datepicker" required>--}}
{{--                                        </div>--}}
{{--                                        <span class="form-text m-b-none text-danger"> @error('expire_at') {{ $message }} @enderror </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-12">--}}
{{--                                    <!---CONTROL BUTTON--->--}}
{{--                                    <div class="form-group">--}}
{{--                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('common.submit')}}</button>--}}
{{--                                        <a class="btn btn-danger" href="{{route( strtolower($pageTitle) . '.index')}}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>{{ trans('common.go_back')}}</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
