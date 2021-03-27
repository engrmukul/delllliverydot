@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12 ">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/20restaurants32.png')}}" width="36" height="36" /> Edit Restaurant Review</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <a class="backToList" href="{{route( strtolower($pageTitle) . '.reviews')}}"><i class="fa fa-angle-left"></i> Back to {{ trans('common.go_back')}}</a>
                    </div>
                    <div class="ibox-content">

                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $reviewEdit->id )}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="id" value="{{ $reviewEdit->id }}">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!---review--->
                                    <div class="form-group">
                                        <label for="review" class="font-bold">{{ trans('review.review')}}</label>
                                        <input type="text" name="review" value="{{ old('review', $reviewEdit->review) }}" placeholder="{{ trans('review.review')}}" class="form-control" required>
                                        <span class="form-text m-b-none text-danger"> @error('review') {{ $message }} @enderror </span>
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

            let isDiscounted = "{{$reviewEdit->is_discounted}}";

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
