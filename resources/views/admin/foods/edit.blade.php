@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/30food32.png')}}" width="36" height="36" /> Edit Food Item</h1>
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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $food->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{$food->id}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <!---food Name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('food.name')}}</label>
                                        <input type="text" name="name" value="{{old('name', $food->name)}}" placeholder="{{ trans('food.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- food ingredients --->
                                    <div class="form-group">
                                        <label for="ingredients" class="font-bold">{{ trans('food.ingredients')}}</label>
                                        <textarea name="ingredients" placeholder="{{ trans('food.ingredients')}}" class="form-control">{{ old('ingredients', $food->ingredients) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('ingredients') {{ $message }} @enderror </span>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <!--- restaurant_id --->
                                    <div class="form-group">
                                        <label for="restaurant_id" class="font-bold">{{ trans('food.restaurant_id')}}</label>
                                        <select id="restaurant_id" class="form-control restaurant-select mt-15" name="restaurant_id" required>
                                            <option value="">{{ trans('food.restaurant_id')}}</option>
                                            @foreach($restaurants as $key => $restaurant)
                                                @if (old('restaurant_id', $food->restaurant_id) == $restaurant->id)
                                                    <option value="{{ $restaurant->id }}" selected> {{ ucfirst($restaurant->name) }} </option>
                                                @else
                                                    <option value="{{ $restaurant->id }}"> {{ ucfirst($restaurant->name) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('restaurant_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- category_id --->
                                    <div class="form-group">
                                        <label for="category_id" class="font-bold">{{ trans('food.category_id')}}</label>
                                        <select id="category_id" class="form-control category-select mt-15" name="category_id" required>
                                            <option value="">{{ trans('food.category_id')}}</option>
                                            @foreach($categories as $key => $category)
                                                @if (old('category_id', $food->category_id) == $category->id)
                                                    <option value="{{ $category->id }}" selected> {{ ucfirst($category->name) }} </option>
                                                @else
                                                    <option value="{{ $category->id }}"> {{ ucfirst($category->name) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('category_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Image--->
                                    <div class="form-group col-md-6">
                                        <img src="{{$food->image}}" alt="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="images" class="font-bold">{{ trans('food.image')}}</label>
                                        <input type="file" id="images" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('images') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <!---ADD MORE FOOD VARIANT--->
                            <div class="row">

                                <div class="col-12">
                                    @forelse($food->foodVariants as $key => $foodVariant)
                                        <div id="inputFormRow">
                                            <div class="input-group mb-3">
                                                <input type="text" name="variant_name[]" value="{{ old('variant_name[]', $foodVariant->name) }}" class="form-control m-input" placeholder="Enter food variant name" autocomplete="off" required>
                                                <input type="number" name="variant_price[]" value="{{ old('variant_price[]', $foodVariant->price) }}" class="form-control m-input" placeholder="Enter price" autocomplete="off" required>
                                                <div class="input-group-append">
                                                    <button type="button" @if($key != 0) id="removeRow" @else  @endif class="btn btn-danger">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                    <div id="newRow"></div>
                                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                                </div>

                            </div>

                            <!---ADD EXTRA--->
                            <div class="row">

                                <div class="col-12">
                                    @forelse($food->extra as $key => $extra)
                                        <div id="inputExtraFormRow">
                                            <div class="input-group mb-3">
                                                <input type="text" name="extra_name[]" value="{{ old('extra_name[]', $extra->name) }}" class="form-control m-input" placeholder="Enter food extra name" autocomplete="off">
                                                <input type="number" name="extra_price[]" value="{{ old('extra_price[]', $extra->price) }}" class="form-control m-input" placeholder="Enter price" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button type="button" @if($key != 0) id="removeExtraRow" @else  @endif class="btn btn-danger">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div id="inputExtraFormRow">
                                            <div class="input-group mb-3">
                                                <input type="text" name="extra_name[]" class="form-control m-input" placeholder="Enter food extra name" autocomplete="off">
                                                <input type="number" name="extra_price[]" class="form-control m-input" placeholder="Enter extra price" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse

                                    <div id="newExtraRow"></div>
                                    <button id="addExtraRow" type="button" class="btn btn-info">Add Row</button>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <!---CONTROL BUTTON--->
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Edit Food</button>
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
    <script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="variant_name[]" class="form-control m-input" placeholder="Enter food variant name" autocomplete="off">';
            html += '<input type="text" name="variant_price[]" class="form-control m-input" placeholder="Enter price" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });

        // add extra
        $("#addExtraRow").click(function () {
            var html = '';
            html += '<div id="inputExtraFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="extra_name[]" class="form-control m-input" placeholder="Enter food extra name" autocomplete="off">';
            html += '<input type="text" name="extra_price[]" class="form-control m-input" placeholder="Enter price" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeExtraRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newExtraRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeExtraRow', function () {
            $(this).closest('#inputExtraFormRow').remove();
        });

        $(document).ready(function() {
            $('.category-select, .restaurant-select').select2();
        });
    </script>
@endpush
