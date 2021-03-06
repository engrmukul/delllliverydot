@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/31review32.png')}}" width="36" height="36" /> Add Food Category</h1>
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

                                        <!---category Name--->
                                        <div class="form-group">
                                            <label for="name" class="font-bold">{{ trans('category.name')}}</label>
                                            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('category.name')}}" class="form-control" required>
                                            <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                        </div>

                                        <!--- description --->
                                        <div class="form-group">
                                            <label for="description" class="font-bold">{{ trans('category.description')}}</label>
                                            <textarea name="description" placeholder="{{ trans('category.description')}}" class="form-control summernote" required>{{ old('description') }}</textarea>
                                            <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                                        </div>

                                        <!---Image--->
                                        <div class="form-group">
                                            <label for="images" class="font-bold">{{ trans('category.image')}}</label>
                                            <input type="file" id="images" name="image" class="form-control">
                                            <span class="form-text m-b-none text-danger"> @error('images') {{ $message }} @enderror </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-12">
                                       <!---CONTROL BUTTON--->
                                       <div class="form-group">
                                           <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Add Category</button>
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
