@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> Permission {{ trans('common.create')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <!---FORM--->
                        <form permission="form" method="post" action="{{route( strtolower($pageTitle) . '.store')}}">
                            @csrf
                                
                            <!---Name--->
                            <div class="form-group">
                                <label for="name" class="font-bold">{{ trans('permission.name')}}</label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('permission.name')}}" maxlength="255" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                            </div>

                            <!---Slug--->
                            <div class="form-group">
                                <label for="slug" class="font-bold">{{ trans('permission.slug')}}</label>
                                <input type="text" name="slug" value="{{ old('slug') }}" placeholder="{{ trans('permission.slug')}}" maxlength="255" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('slug') {{ $message }} @enderror </span>
                            </div>

                            <!---CONTROL BUTTON--->
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('common.submit')}}</button>
                                    <a class="btn btn-danger" href="{{route( strtolower($pageTitle) . '.index')}}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>{{ trans('common.go_back')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
