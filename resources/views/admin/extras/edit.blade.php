@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> {{ $pageTitle }} Update Form</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $extra->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $extra->id }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <!---extra Name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('extra.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name', $extra->name) }}" placeholder="{{ trans('extra.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- description --->
                                    <div class="form-group">
                                        <label for="description" class="font-bold">{{ trans('extra.description')}}</label>
                                        <textarea name="description" placeholder="{{ trans('extra.description')}}" class="form-control summernote" required>{{ old('description', $extra->description) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- extra price --->
                                    <div class="form-group">
                                        <label for="price" class="font-bold">{{ trans('extra.price')}}</label>
                                        <input type="text" id="price" name="price" value="{{ old('price', $extra->price) }}" placeholder="{{ trans('extra.price')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('price') {{ $message }} @enderror </span>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <!--- extra group --->
                                    <div class="form-group">
                                        <label for="extra_group_id" class="font-bold">{{ trans('extra.extra_group_id')}}</label>
                                        <select id="extra_group_id" class="form-control custom-select mt-15" name="extra_group_id" required>
                                            <option value="">{{ trans('extra.extra_group_id')}}</option>
                                            @foreach($groups as $key => $group)
                                                @if (old('extra_group_id', $extra->extra_group_id) == $group->id)
                                                    <option value="{{ $group->id }}" selected> {{ ucfirst($group->name) }} </option>
                                                @else
                                                    <option value="{{ $group->id }}"> {{ ucfirst($group->name) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('extra_group_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- food --->
                                    <div class="form-group">
                                        <label for="food_id" class="font-bold">{{ trans('extra.food')}}</label>
                                        <select id="food_id" class="form-control custom-select mt-15" name="food_id" required>
                                            <option value="">{{ trans('extra.food_id')}}</option>
                                            @foreach($foods as $key => $food)
                                                @if (old('food_id',$extra->food_id) == $food->id)
                                                    <option value="{{ $food->id }}" selected> {{ ucfirst($food->name) }} </option>
                                                @else
                                                    <option value="{{ $food->id }}"> {{ ucfirst($food->name) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('food_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Image--->
                                    <div class="form-group">
                                        <label for="images" class="font-bold">{{ trans('extra.image')}}</label>
                                        <input type="file" id="images" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('images') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!---CONTROL BUTTON--->
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('common.update')}}</button>
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
