@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> food {{ trans('common.create')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
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

                                    <!--- short description --->
                                    <div class="form-group">
                                        <label for="short_description" class="font-bold">{{ trans('food.short_description')}}</label>
                                        <textarea name="short_description" placeholder="{{ trans('food.short_description')}}" class="form-control summernote" required>{{ old('short_description', $food->short_description) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('short_description') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- food description --->
                                    <div class="form-group">
                                        <label for="description" class="font-bold">{{ trans('food.description')}}</label>
                                        <textarea name="description" placeholder="{{ trans('food.description')}}" class="form-control summernote" required>{{ old('description', $food->description) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- food ingredients --->
                                    <div class="form-group">
                                        <label for="ingredients" class="font-bold">{{ trans('food.ingredients')}}</label>
                                        <textarea name="ingredients" placeholder="{{ trans('food.ingredients')}}" class="form-control summernote" required>{{ old('ingredients', $food->ingredients) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('ingredients') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <!--- food discount_price --->
                                    <div class="form-group">
                                        <label for="discount_price" class="font-bold">{{ trans('food.discount_price')}}</label>
                                        <input type="text" id="discount_price" name="discount_price" value="{{ old('discount_price', $food->discount_price) }}" placeholder="{{ trans('food.discount_price')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('discount_price') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- unit  --->
                                    <div class="form-group">
                                        <label for="unit" class="font-bold">{{ trans('food.unit')}}</label>
                                        <input type="text" id="unit" name="unit" value="{{ old('unit', $food->unit) }}" placeholder="{{ trans('food.unit')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('unit') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- package_count --->
                                    <div class="form-group">
                                        <label for="package_count" class="font-bold">{{ trans('food.package_count')}}</label>
                                        <input type="text" id="package_count" name="package_count" value="{{ old('package_count', $food->package_count) }}" placeholder="{{ trans('food.package_count')}}" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('package_count') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- weight --->
                                    <div class="form-group">
                                        <label for="weight" class="font-bold">{{ trans('food.weight')}}</label>
                                        <input type="text" id="weight" name="weight" value="{{ old('weight', $food->weight) }}" placeholder="{{ trans('food.weight')}}" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('weight') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- featured --->
                                    <div class="form-group">
                                        <label for="featured" class="font-bold">{{ trans('food.featured')}}</label>
                                        <select id="featured" class="form-control custom-select mt-15" name="featured" required>
                                            <option value="">{{ trans('food.featured')}}</option>
                                            @foreach($features as $key => $feature)
                                                @if (old('featured', $food->featured) == $key)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($feature) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($feature) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('featured') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- deliverable_food --->
                                    <div class="form-group">
                                        <label for="deliverable_food" class="font-bold">{{ trans('food.deliverable_food')}}</label>
                                        <select id="deliverable_food" class="form-control custom-select mt-15" name="deliverable_food" required>
                                            <option value="">{{ trans('food.deliverable_food')}}</option>
                                            @foreach($deliverableFoods as $key => $deliverableFood)
                                                @if (old('deliverable_food', $food->deliverable_food) == $key)
                                                    <option value="{{ $key }}" selected> {{ ucfirst($deliverableFood) }} </option>
                                                @else
                                                    <option value="{{ $key }}"> {{ ucfirst($deliverableFood) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('deliverable_food') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- restaurant_id --->
                                    <div class="form-group">
                                        <label for="restaurant_id" class="font-bold">{{ trans('food.restaurant_id')}}</label>
                                        <select id="restaurant_id" class="form-control custom-select mt-15" name="restaurant_id" required>
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
                                        <select id="category_id" class="form-control custom-select mt-15" name="category_id" required>
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
                                    <div class="form-group">
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

                            <div class="row mt-3">
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
    </script>
@endpush
