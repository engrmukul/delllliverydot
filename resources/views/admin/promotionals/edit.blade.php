@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/70customers32.png')}}" width="36" height="36" /> Edit Banner Data</h1>
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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $promotional->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{$promotional->id}}">

                            <div class="row">
                                <div class="col-md-6">
                                    <!---name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('promotional.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name',$promotional->name) }}" placeholder="{{ trans('promotional.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Image--->
                                    <div class="form-group">
                                        <label for="image" class="font-bold">{{ trans('promotional.image')}}</label>
                                        <input type="file" name="image" value="{{ old('image',$promotional->image) }}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('image') {{ $message }} @enderror </span>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <img src="{{$promotional->image}}" alt="">
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
