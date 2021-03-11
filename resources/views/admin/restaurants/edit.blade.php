@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12 ">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/20restaurants32.png')}}" width="36" height="36" /> Edit Restaurant</h1>
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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $restaurant->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $restaurant->id }}">

                        <!--RESTAURANT--->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!---Name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('restaurant.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" placeholder="{{ trans('restaurant.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Email--->
                                    <div class="form-group">
                                        <label for="email" class="font-bold">{{ trans('restaurant.email')}}</label>
                                        <input type="text" name="email" value="{{ old('email', $restaurant->email) }}" placeholder="{{ trans('restaurant.email')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('email') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Phone--->
                                    <div class="form-group">
                                        <label for="phone_number" class="font-bold">{{ trans('restaurant.phone_number')}}</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', $restaurant->phone_number) }}" placeholder="{{ trans('restaurant.phone_number')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('phone_number') {{ $message }} @enderror </span>
                                    </div>

                                    <!---NID--->
                                    <div class="form-group">
                                        <label for="nid" class="font-bold">{{ trans('restaurant.nid')}}</label>
                                        <input type="text" name="nid" value="{{ old('nid', $restaurant->restaurantDetails->nid) }}" placeholder="{{ trans('restaurant.nid')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('nid') {{ $message }} @enderror </span>
                                    </div>

                                    <!---trade_licence--->
                                    <div class="form-group">
                                        <label for="trade_licence" class="font-bold">{{ trans('restaurant.trade_licence')}}</label>
                                        <input type="text" name="trade_licence" value="{{ old('trade_licence', $restaurant->restaurantDetails->trade_licence) }}" placeholder="{{ trans('restaurant.trade_licence')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('trade_licence') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_fee--->
                                    <div class="form-group">
                                        <label for="delivery_fee" class="font-bold">{{ trans('restaurant.delivery_fee')}}</label>
                                        <input type="text" name="delivery_fee" value="{{ old('delivery_fee', $restaurant->restaurantDetails->delivery_fee) }}" placeholder="{{ trans('restaurant.delivery_fee')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_fee') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_time--->
                                    <div class="form-group">
                                        <label for="delivery_time" class="font-bold">{{ trans('restaurant.delivery_time')}}</label>
                                        <input type="text" name="delivery_time" value="{{ old('delivery_time', $restaurant->restaurantDetails->delivery_time) }}" placeholder="{{ trans('restaurant.delivery_time')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_time') {{ $message }} @enderror </span>
                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <!---closed_restaurant--->
                                    <div class="form-group">
                                        <label for="closed_restaurant">{{ trans('restaurant.closed_restaurant')}}</label>
                                        <select id="closed_restaurant" class="form-control custom-select mt-15" name="closed_restaurant" required>
                                            <option value="">{{ trans('restaurant.closed_restaurant')}}</option>
                                            @foreach($closedRestaurants as $key => $closedRestaurant)
                                                @if (old('closed_restaurant', $restaurant->restaurantDetails->closed_restaurant) == $key)
                                                    <option value="{{ $closedRestaurant }}" selected> {{ ucfirst($closedRestaurant) }} </option>
                                                @else
                                                    <option value="{{ $closedRestaurant }}"> {{ ucfirst($closedRestaurant) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('closed_restaurant') {{ $message }} @enderror </span>
                                    </div>
                                    <!---description--->
                                    <div class="form-group">
                                        <label for="description" class="font-bold">{{ trans('restaurant.description')}}</label>
                                        <textarea name="description"
                                                  placeholder="{{ trans('restaurant.description')}}"
                                                  class="form-control"
                                                  required>{!! old('description', $restaurant->restaurantDetails->description) !!} </textarea>
                                        <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                                    </div>

                                    <!---delivery_range--->
                                    <div class="form-group">
                                        <label for="delivery_range" class="font-bold">{{ trans('restaurant.delivery_range')}}</label>
                                        <input type="text" name="delivery_range" value="{{ old('delivery_range', $restaurant->restaurantDetails->delivery_range) }}" placeholder="{{ trans('restaurant.delivery_range')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('delivery_range') {{ $message }} @enderror </span>
                                    </div>

                                    <!---address--->
                                    <div class="form-group">
                                        <label for="address" class="font-bold">{{ trans('restaurant.address')}}</label>
                                        <input type="text" name="address" value="{!! old('address', $restaurant->restaurantDetails->address) !!}" placeholder="{{ trans('restaurant.address')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
                                    </div>

                                    <!---image--->
                                    <div class="form-group">
                                        <label for="images" class="font-bold">{{ trans('restaurant.image')}}</label>
                                        <input type="file" id="images" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('image') {{ $message }} @enderror </span>
                                    </div>

                                    <!---CHECKBOX--->
                                    <div class="form-group">
                                        <label for="category" class="font-bold">Category Check</label>
                                        <div class="col-sm-10">
                                            <label class="checkbox-inline"><input type="checkbox" name="is_favorite" value="yes" @if($restaurant->is_favorite == 'yes') checked @else @endif id="inlineCheckbox2"> Is Favorite </label>
                                            <label class="checkbox-inline"><input type="checkbox" name="is_discounted" value="yes" @if($restaurant->is_discounted == 'yes') checked @else @endif id="isDiscounted"> Is Discounted </label>
                                            <label class="checkbox-inline"><input type="checkbox" name="is_trending" value="yes" @if($restaurant->is_trending == 'yes') checked @else @endif id="inlineCheckbox2"> Is Trending </label>
                                            <label class="checkbox-inline"><input type="checkbox" name="is_popular" value="yes" @if($restaurant->is_popular == 'yes') checked @else @endif id="inlineCheckbox2"> Is Popular </label>
                                        </div>
                                    </div>


                                    <!---discount--->
                                    <div class="form-group discount d-none">
                                        <label for="discount" class="font-bold">{{ trans('restaurant.discount')}}</label>
                                        <input type="number" name="discount" value="{{ old('discount', $restaurant->restaurantDetails->discount) }}" placeholder="{{ trans('restaurant.discount')}}" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('discount') {{ $message }} @enderror </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="status" class="font-bold">Status</label>
                                        <div class="col-sm-10">
                                            <label class="checkbox-inline"><input type="checkbox" name="status" value="active" @if($restaurant->status == 'active') checked @else @endif id="inlineCheckbox2"> Active</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status" class="font-bold">Is Verified</label>
                                        <div class="col-sm-10">
                                            <label class="checkbox-inline"><input type="checkbox" name="isVerified" value="1" @if($restaurant->isVerified == '1') checked @else @endif id="inlineCheckbox2"> Is Verified</label>
                                        </div>
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

@push('scripts')
    <script>
        $(document).ready(function() {

            let isDiscounted = "{{$restaurant->is_discounted}}";

            if(isDiscounted == 'yes'){
                $('.discount').removeClass('d-none');
            }else{
                $('.discount').addClass('d-none');
            }

            $("#isDiscounted").click(function() {

                if($(this).prop("checked") == true){
                    $('.discount').removeClass('d-none');
                } else {
                    $('.discount').addClass('d-none');
                    $('input[name=discount]').val('');
                }
            });
        });
    </script>
@endpush
