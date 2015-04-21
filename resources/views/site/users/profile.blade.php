@extends('site._layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h2 class="">{{ trans('common.Edit profile') }} – {{ $user->name }}</h2>

            <div class="well">
                {!! form($form) !!}
            </div>
        </div>
    </div>

@stop
