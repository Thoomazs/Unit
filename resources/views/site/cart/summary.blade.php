@extends('site._layouts.master')

@section('content')

    <div class="box">
        <div class="row">

            <div class="col-sm-12">
                @include("site.cart._title", ['step' => 4])

                {!! Form::model($order, ['route' => [ 'cart.summary' ], 'method' => 'POST' ] ) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <h3>Osobní údaje</h3>

                        <p>{{ $order->name }}</p>

                        <p>{{ $order->email }}</p>

                        <p>{{ $order->phone }}</p>

                    </div>
                    <div class="col-sm-6">
                        <h3>Doručovací adresa</h3>

                        <p>{{ $order->street }}, {{ $order->city }}, {{ $order->postcode }}</p>

                        @if( !is_null($order->billingAddress) )
                            <h3>Fakturační adresa</h3>
                            <p>{{ $order->billingAddress->street }}, {{ $order->billingAddress->city }}, {{ $order->billingAddress->postcode }}</p>
                        @endif
                    </div>
                </div>

                <hr/>

                <ul class="cart-items summary">
                    @foreach($order->items as $item)

                        <li class="cart-item">

                            <div class="row">
                                <div class="cart-item-img col-sm-1">
                                    <a href="{{ route("products.detail", [ $item->slug ]) }}">
                                        <img class="img-responsive img-rounded" src="{{ $item->photo }}" alt="{{ $item->name }}"/>
                                    </a>
                                </div>
                                <div class="cart-item-title col-sm-7">
                                    <a href="{{ route("products.detail", [ $item->slug ]) }}">
                                        <h4>{{ $item->product->name }} – {{ $item->name }}</h4>
                                    </a>

                                </div>
                                <div class="cart-item-quantity col-sm-2 text-right">
                                    {{ $item->quantity }} {{ trans('ks') }}
                                </div>
                                <div class="cart-item-price col-sm-2 text-right h4">
                                    <span class="text-info font-weight-semibold">{{ $item->totalPrice }} {{ trans("common.CURRENCY")  }}</span>
                                </div>
                            </div>
                        </li>

                    @endforeach
                </ul>

                <div class="h4">
                    {{ $order->payment->name }}
                    <span class="pull-right text-info">
                        @if( $order->payment->price == 0)
                            zdarma
                        @else
                            {{ $order->payment->price }}  {{ trans("common.CURRENCY")  }}
                        @endif
                    </span>
                </div>

                <hr/>

                <div class="h4">
                    {{ $order->shipping->name }}
                    <span class="pull-right text-info">
                        @if( $order->shipping->price == 0)
                            zdarma
                        @else
                            {{ $order->shipping->price }}  {{ trans("common.CURRENCY")  }}
                        @endif
                    </span>
                </div>

                <hr/>

                <div class="text-right font-weight-bold h3">
                    celková cena: <span class="text-info">{{ $order->price. ' ' . trans('common.CURRENCY') }} </span>
                </div>

                <hr/>

                <div>
                    {!! Form::button(trans('common.Finish order'), ['type' => 'submit', 'class' => 'btn btn-lg btn-success btn-block']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
