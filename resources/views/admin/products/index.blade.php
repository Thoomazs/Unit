@extends('admin._layouts.master')

@section('title')
    Product index | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'products'])
@stop

@section('content')

    <div class="controls">
        <div class="row">
            <div class="col-sm-4">
                {!! Form::open(['method' => 'GET']) !!}
                <div class="input-group">
                    {!! Form::text('s', Input::get('s'), [ 'class' => 'form-control', 'autofocus' => 'true' ] ) !!}

                        <span class="input-group-btn">
                            {!! Form::submit(trans('common.Search'), [ 'class' => 'btn btn-primary pull-right' ]) !!}
                        </span>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="col-sm-4 hidden-xs">
                <a href="{{ route('admin.products.create') }}" class="create btn btn-primary">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="col-sm-4">
                <div class="pull-right">
                    @include("templates.pagination", ["paginator" => $products, "type" => "simple"])
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-condensed table-bordered table-responsive table-striped table-hover no-margin-bottom">
            <thead>
            <tr>
                <th class="id">{{ trans('common.ID') }}</th>
                <th>{{ trans('common.Name') }}</th>
                <th>{{ trans('common.Stock') }}</th>
                <th>{{ trans('common.Price') }}</th>
                <th>{{ trans('common.Action') }}</th>
            </tr>
            </thead>
            <tbody>

            @if( count( $products) > 0)

                @foreach($products as $product)
                    <tr>
                        <td class="id">
                            {{ $product->id }}
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ $product->stock }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td class="actions">
                            <a class="update btn btn-xs btn-success" href="{{ route('admin.products.edit', [$product->id] ) }}" title="Edit">
                                <i class="fa fa-cog"></i>
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('products.detail', [$product->slug] ) }}" title="Show" target="_blank">
                                <i class="fa fa-camera"></i>
                            </a>


                            <div class="inline-block" title="Delete">

                                {!! Form::open(array('route' => ['admin.products.destroy', $product->id ], 'method' => 'DELETE')) !!}

                                {!! Form::hidden( 'id', $product->id ); !!} {!! Form::button( '<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-xs
                                btn-danger', 'data-warning' => 'true']); !!}

                                {!! Form::close() !!}

                            </div>
                        </td>
                    </tr>
                @endforeach

            @else
                <tr>
                    <td colspan="99" class="end">
                        {{ trans('common.No records were found') }}
                    </td>
                </tr>
            @endif

            </tbody>
        </table>

        @if( count( $products) > 0)
            <div class="controls overflow-hidden">
                <div class="pull-right">
                    @include("templates.pagination", ["paginator" => $products])
                </div>
            </div>
        @endif

    </div>
    </div>

@stop