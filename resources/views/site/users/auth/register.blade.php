@extends('site._layouts.master')

@section('content')

<div id="register">
   <div class="col-sm-6 col-sm-offset-3">

       <div class="box">

           <h2 class="form-header">{{ trans('common.Register') }}</h2>

           {!! form($form) !!}

        </div>
    </div>
</div>

@stop
