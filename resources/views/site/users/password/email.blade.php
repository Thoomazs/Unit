@extends('site._layouts.master')

@section('content')

    <div class="col-sm-6 col-sm-offset-3">

        <div class="well">

            <h2 class="form-header">{{ trans('common.Reset Password') }}</h2>

            {!! form($form) !!}

        </div>
    </div>

@stop
