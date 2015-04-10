@extends('site._layouts.master')

@section('content')

    <div class="box">
        <div class="row">
            <div class="col-sm-12">

                @include("site.cart._title", ['step' => 1])

                @if( $order and count($order->items) > 0 )
                    <ul class="cart-items">
                        @foreach($order->items as $item)
                            @include("site.cart._item")
                        @endforeach
                    </ul>

                    <div class="text-right font-weight-bold h4">
                            celková cena: <span class="text-info">{{ $order->itemPrice. ' ' . trans('common.CURRENCY') }} </span>
                    </div>

                    <hr/>

                    <div>
                        <a class="btn btn-default" href="{{ route('home') }}">{{ trans('Pokračovat v nákupu') }}</a>

                        <a class="btn btn-success pull-right" href="{{ route('cart.delivery-information') }}">{{ trans('common.Continue') }}</a>
                    </div>
                @else
                    <p class="text-center muted">{{ trans('messages.cart.empty') }}</p>
                @endif
            </div>
        </div>
    </div>
@stop
