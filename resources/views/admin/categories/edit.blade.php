@extends('admin._layouts.master')


@section('title')
    {{ $category->name }} | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'category', 'data' => $category])
@stop

@section('content')

<div class="row form margin-top">
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">

        <div class="well">

            <h2 class="form-header">
                #{{ $category->id }} {{ $category->name }}

                <div class="pull-right">

                    {!! Form::open(array('route' => ['admin.categories.destroy', $category->id ], 'method' => 'DELETE', 'class' => 'inline-block')) !!}

                    {!! Form::button( '<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-warning' => 'true']) !!}

                    {!! Form::close() !!}

                </div>
                
            </h2>

            {!! form($form) !!}

        </div>
    </div>
</div>
@stop
