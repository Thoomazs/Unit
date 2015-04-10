@extends('site._layouts.master')

@section('content')

    <div class="box">

        <h2 class="form-header">{{ trans('common.Edit profile') }} – {{ $user->name }}</h2>

        {!! form($form) !!}

    </div>
@stop
