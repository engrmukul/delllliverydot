@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-book"></i> coupon {{ trans('common.create')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> {{ trans('common.list')}}</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <!---type-->
                                    <div class="form-group">
                                        <label for="type">{{ trans('termsAndCondition.type')}}</label>
                                        <select id="type" class="form-control custom-select mt-15" name="type" required>
                                            <option value="">{{ trans('termsAndCondition.type')}}</option>
                                            @foreach($types as $key => $type)
                                                @if (old('type',$termsAndCondition->type) == $type)
                                                    <option value="{{ $type }}" selected> {{ ucfirst($type) }} </option>
                                                @else
                                                    <option value="{{ $type }}"> {{ ucfirst($type) }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('type') {{ $message }} @enderror </span>
                                    </div>

                                <!---question--->
                                    <div class="form-group">
                                        <label for="description" class="font-bold">{{ trans('termsAndCondition.question')}}</label>
                                        <textarea name="description"
                                                  placeholder="{{ trans('termsAndCondition.description')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('description') }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
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
