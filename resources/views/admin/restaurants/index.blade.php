@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    @include('admin.partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/20restaurants32.png')}}" width="36" height="36" /> Restaurant Lists</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Add new Restaurant</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            @include('admin.partials.datatable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
