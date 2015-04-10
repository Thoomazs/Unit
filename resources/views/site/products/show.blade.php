@extends('site._layouts.master')

@section('content')


    <div class="box">
        <div id="product-detail">
            <div class="row">

                <div class="col-sm-4">
                    <div class="product-img">

                        <img class="img-responsive" src="{{ $product->photo }}" alt=""/>

                        @if( count($product->photos) > 0)
                            <div class="product-photos">
                                @foreach($product->photos as $photos)
                                    <img class="img-responsive" src="{{ $photos->photo }}" alt=""/>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="product-name">
                        <h1>{{ $product->name }}</h1>
                    </div>

                    <hr/>

                    {!! Form::open([ 'route' => 'cart.add', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic' ]) !!}
                        {!! Form::hidden('product_id', $product->id) !!}
                        <div class="row">
                        @if( $product->stock > 0)
                            <div class="col-sm-4">
                                <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                    {!! Form::input('number', 'quantity', 1, ['class' => 'form-control input-lg', 'autocomplete' => 'off', 'min' => 1, 'max' => $product->stock]) !!}
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    {!! Form::button( $product->price . ' ' . trans('common.CURRENCY'), ['type' => 'submit', 'class' => 'add btn btn-success btn-lg btn-block']) !!}
                                </div>
                            </div>
                        @else
                            <div class="col-sm-12 product-type-stock-out">
                                <p>Produkt je vyprodán</p>
                            </div>
                        @endif
                        </div>

                    {!! Form::close() !!}
                    <hr/>
                    <div class="product-perex">
                        {!! $product->perex !!}
                    </div>
                    <div class="product-desc">
                        {!! $product->desc !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop