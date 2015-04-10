@extends('site._layouts.master')

@section('content')

    <div class="box">
        <div class="row">

            <div class="col-sm-12">
                @include("site.cart._title", ['step' => 3])

                {!! Form::model($order, ['route' => [ 'cart.shipping-and-payment' ], 'method' => 'POST' ] ) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <h3 style="margin-top: 5px;">Způsob platby</h3>

                        <ul class="nav">
                            @foreach($payments as $p)
                                <li>
                                    <!-- Payment Form Radio Input -->

                                    <div class="form-group {{ $errors->has('payment_id') ? 'has-error' : '' }}">
                                        <div class="radio">
                                            {!! Form::radio( 'payment_id', $p->id, ($p->id == $order->payment_id), ['id' => 'payment_'.$p->id]) !!}

                                            <label for="{{ 'payment_'.$p->id }}" class="block" data-price="{{ $p->price }}">
                                                {{ $p->name }}

                                                @if( $p->price == 0)
                                                    <span class="pull-right font-weight-bold muted">
                                                        zdarma
                                                    </span>
                                                @else
                                                    <span class="pull-right font-weight-bold text-info">
                                                        {{ $p->price . ' ' . trans('common.CURRENCY')}}
                                                    </span>
                                                @endif
                                            </label>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-sm-6">
                        <h3 style="margin-top: 5px;">Způsob dopravy</h3>

                        <ul class="nav">
                            @foreach($shippings as $s)
                                <li>
                                    <!-- Shipping Form Radio Input -->

                                    <div class="form-group {{ $errors->has('shipping_id') ? 'has-error' : '' }}">
                                        <div class="radio">
                                            {!! Form::radio( 'shipping_id', $s->id, ($s->id == $order->shipping_id), ['id' => 'shipping_'.$s->id]) !!}


                                            <label for="{{ 'shipping_'.$s->id }}" class="block" data-price="{{ $s->price }}">
                                                {{ $s->name }}

                                                @if( $s->price == 0)
                                                    <span class="pull-right font-weight-bold muted">
                                                        zdarma
                                                    </span>
                                                @else
                                                    <span class="pull-right font-weight-bold text-info">
                                                        {{ $s->price . ' ' . trans('common.CURRENCY')}}
                                                    </span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <hr/>

                <div class="text-right font-weight-bold h4">
                    celková cena: <span class="text-info"> <span class="total-price" data-price="{{ $order->price }}">{{ $order->price }}</span> {{ trans('common.CURRENCY') }} </span>
                </div>

                <hr/>

                <div>
                    <a class="btn btn-default" href="{{ route('cart.delivery-information') }}">{{ trans('common.Delivery information') }}</a>

                    {!! Form::button(trans('common.Continue'), ['type' => 'submit', 'class' => 'btn btn-success pull-right']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
