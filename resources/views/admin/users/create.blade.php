@extends('admin._layouts.master')

@section('title')
    {{ trans('common.New user') }} | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'user'])
@stop

@section('content')

    <div class="row form margin-top">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">

            <div class="well">

                <h2 class="form-header">{{ trans('common.New user') }}</h2>

                {!! form($form) !!}

            </div>
        </div>
    </div>
@stop
