@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    @include('admin.partials.flash')
    <style>
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td{
            padding: 5px !important;
        }
    </style>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row header_part">
            <div class="col-12">
                <h1 class="ddheadline"><img src="{{url('/public/img/icons/31review32.png')}}" width="36" height="36" /> Food Category</h1>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Add new Category</a>
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
