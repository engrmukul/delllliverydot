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
        <div class="row">
            <div class="col-md-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-list"></i> {{ trans('common.list')}}</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> {{ trans('common.create')}}</a>
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
