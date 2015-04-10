@extends('admin._layouts.master')


@section('title')
    {{ $product->name }} | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'product', 'data' => $product])
@stop

@section('content')

    <div class="row form margin-top">
        <div class="col-lg-10 col-lg-offset-1">

            <div class="well">

                <h2 class="form-header">
                    #{{ $product->id }} {{ $product->name }}

                    <div class="pull-right">
                        <a class="btn btn-info btn-sm" target="_blank" href="{{ route('products.detail', [$product->slug]) }}" data-toggle="tooltip" data-placement="left" title="{{ trans('common.Show detail on client page') }}">
                            <i class="fa fa-camera"></i>
                        </a>


                        {!! Form::open(array('route' => ['admin.products.destroy', $product->id ], 'method' => 'DELETE', 'class' => 'inline-block')) !!}

                        {!! Form::button( '<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-warning' => 'true']) !!}

                        {!! Form::close() !!}

                    </div>
                </h2>

                {!! form($form) !!}

            </div>
        </div>
    </div>
@stop
