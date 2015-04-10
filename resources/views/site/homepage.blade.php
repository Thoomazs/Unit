@extends('site._layouts.master')

@section('content')

    <h1>{{ trans('common.Products') }}</h1>

    <div class="box">
        <div class="row">
            @foreach($products as $product)
                @include("site.products._product")
            @endforeach
        </div>
    </div>

@stop
