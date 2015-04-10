@extends('admin._layouts.master')

@section('title')
    {{ trans('common.New category') }} | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'category'])
@stop

@section('content')

    <div class="row form margin-top">
        <div class="col-lg-10 col-lg-offset-1 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">

            <div class="well">

                <h2 class="form-header">{{ trans('common.New category') }}</h2>

                {!! form($form) !!}

            </div>
        </div>
    </div>
@stop
