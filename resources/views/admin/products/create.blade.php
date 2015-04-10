@extends('admin._layouts.master')

@section('title')
    {{ trans('common.New product') }} | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'product'])
@stop

@section('content')

    <div class="row form margin-top">
        <div class="col-lg-10 col-lg-offset-1">

            <div class="well">

                <h2 class="form-header">{{ trans('common.New product') }}</h2>

                {!! form($form) !!}

            </div>
        </div>
    </div>
@stop
