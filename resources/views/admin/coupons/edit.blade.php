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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $course->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <!---Language--->
                                    <div class="form-group">
                                        <label for="language_id">{{ trans('course.language')}}</label>
                                        <input type="hidden" name="id" value="{{ $course->id }}">
                                        <select id="language_id" class="form-control custom-select mt-15" name="language_id" required>
                                            <option value="">{{ trans('course.language')}}</option>
                                            @foreach($languages as $key => $language)
                                                @if (old('language_id',$course->language_id) == $language->id)
                                                    <option value="{{ $language->id }}" selected> {{ $language->name }} </option>
                                                @else
                                                    <option value="{{ $language->id }}"> {{ $language->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('language_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!---course Name--->
                                    <div class="form-group">
                                        <label for="name" class="font-bold">{{ trans('course.name')}}</label>
                                        <input type="text" name="name" value="{{ old('name',$course->name) }}" placeholder="{{ trans('course.name')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- Course category --->
                                    <div class="form-group">
                                        <label for="course_category_id">{{ trans('course.course_category')}}</label>                                <input type="hidden" name="id" value="{{ $course->id }}">
                                        <input type="hidden" name="id" value="{{ $course->id }}">
                                        <select id="course_category_id" class="form-control custom-select mt-15" name="course_category_id" required>
                                            <option value="">{{ trans('course.course_category')}}</option>
                                            @foreach($courseCategories as $key => $courseCategory)
                                                @if (old('course_category_id',$course->course_category_id) == $courseCategory->id)
                                                    <option value="{{ $courseCategory->id }}" selected> {{ $courseCategory->name }} </option>
                                                @else
                                                    <option value="{{ $courseCategory->id }}"> {{ $courseCategory->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('course_category_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- Course Instructor --->
                                    <div class="form-group">
                                        <label for="instructor_id">{{ trans('course.instructor')}}</label>
                                        <input type="hidden" name="id" value="{{ $course->id }}">
                                        <select id="instructor_id" class="form-control custom-select mt-15" name="instructor_id" required>
                                            <option value="">{{ trans('course.instructor')}}</option>
                                            @foreach($instructors as $key => $instructor)
                                                @if (old('instructor_id', $course->instructor_id) == $instructor->id)
                                                    <option value="{{ $instructor->id }}" selected> {{ $instructor->name }} </option>
                                                @else
                                                    <option value="{{ $instructor->id }}"> {{ $instructor->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="form-text m-b-none text-danger"> @error('instructor_id') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- short description --->
                                    <div class="form-group">
                                        <label for="short_description" class="font-bold">{{ trans('course.short_description')}}</label>
                                        <textarea name="short_description" placeholder="{{ trans('course.short_description')}}" class="summernote form-control" required>{{ old('short_description', $course->short_description) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('short_description') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- Course overview --->
                                    <div class="form-group">
                                        <label for="overview" class="font-bold">{{ trans('course.overview')}}</label>
                                        <textarea name="overview" placeholder="{{ trans('course.overview')}}" class="summernote form-control" required>{{ old('overview', $course->overview) }}</textarea>
                                        <span class="form-text m-b-none text-danger"> @error('overview') {{ $message }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <!--- Course price --->
                                    <div class="form-group">
                                        <label for="price" class="font-bold">{{ trans('course.price')}}</label>
                                        <input type="text" id="price" name="price" value="{{ old('price', $course->price) }}" placeholder="{{ trans('course.price')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('price') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- Start date --->
                                    <div class="form-group" id="dateItem">
                                        <label for="start_date" class="font-bold">{{ trans('course.start_date')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="start_date" name="start_date" value="{{ old('start_date', $course->start_date) }}" placeholder="{{ trans('course.start_date')}}" class="form-control" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('start_date') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- End date --->
                                    <div class="form-group" id="dateItem">
                                        <label for="end_date" class="font-bold">{{ trans('course.end_date')}}</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" id="end_date" name="end_date" value="{{ old('end_date', $course->end_date) }}" placeholder="{{ trans('course.end_date')}}" class="form-control" required>
                                        </div>
                                        <span class="form-text m-b-none text-danger"> @error('end_date') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- Total Slot --->
                                    <div class="form-group">
                                        <label for="totalSlot" class="font-bold">{{ trans('course.total_slot')}}</label>
                                        <input type="text" id="total_slot" name="total_slot" value="{{ old('total_slot', $course->total_slot) }}" placeholder="{{ trans('course.total_slot')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('total_slot') {{ $message }} @enderror </span>
                                    </div>

                                    <!--- Resource website --->
                                    <div class="form-group">
                                        <label for="resource_website" class="font-bold">{{ trans('course.resource_website')}}</label>
                                        <input type="text" id="resource_website" name="resource_website" value="{{ old('website', $course->website) }}" placeholder="{{ trans('course.resource_website')}}" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('resource_website') {{ $message }} @enderror </span>
                                    </div>

                                    <!---Image--->
                                    <div class="form-group">
                                        <label for="image" class="font-bold">{{ trans('course.image')}}</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                        <span class="form-text m-b-none text-danger"> @error('image') {{ $message }} @enderror </span>
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
