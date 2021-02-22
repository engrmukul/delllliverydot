@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/91heplandsupport32.png')}}" width="36" height="36" /> Help & Support</h1>
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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $helpAndSupport->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{$helpAndSupport->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <!---type-->
                                    <div class="form-group">
                                        <label for="type">{{ trans('helpAndSupprt.type')}}</label>
                                        <select id="type" class="form-control custom-select mt-15" name="type" required>
                                            <option value="">{{ trans('helpAndSupprt.type')}}</option>
                                            @foreach($types as $key => $type)
                                                @if (old('type',$helpAndSupport->type) == $type)
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
                                        <label for="question" class="font-bold">{{ trans('helpAndSupprt.question')}}</label>
                                        <textarea name="question"
                                                  placeholder="{{ trans('helpAndSupprt.question')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('question', $helpAndSupport->question) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('question') {{ $message }} @enderror </span>
                                    </div>

                                    <!---answer--->
                                    <div class="form-group">
                                        <label for="answer" class="font-bold">{{ trans('helpAndSupprt.answer')}}</label>
                                        <textarea name="answer"
                                                  placeholder="{{ trans('helpAndSupprt.answer')}}"
                                                  class="form-control summernote"
                                                  required>{{ old('answer', $helpAndSupport->answer) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('answer') {{ $message }} @enderror </span>
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
