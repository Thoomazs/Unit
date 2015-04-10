@extends('site._layouts.master')

@section('content')
    <div class="box">
        <div class="row">
            <div class="col-sm-12">

                @include("site.cart._title", ['step' => 2])


                @if ( Auth::guest())
                    <div>
                        Již mám účet?
                        <a class="btn btn-default btn-sm" href="{{ route('auth.login') }}">{{ trans('common.Login') }}</a>
                    </div>

                    <hr/>
                @endif

                {!! Form::model($order, ['route' => [ 'cart.delivery-information' ], 'method' => 'POST' ] ) !!}

                <h3>Osobní údaje</h3>

                <div class="row">

                    <!-- Firstname Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('firstname') ? 'has-error' : '' }}">
                        {!! Form::label('firstname', trans('Firstname') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('firstname', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('firstname', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <!-- Lastname Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('lastname') ? 'has-error' : '' }}">
                        {!! Form::label('lastname', trans('Lastname')  . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('lastname', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('lastname', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <!-- Email Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('email') ? 'has-error' : '' }}">
                        {!! Form::label('email', trans('Email') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('email', '<div class="form-error">:message</div>') !!}

                            {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <!-- Phone Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('phone') ? 'has-error' : '' }}">
                        {!! Form::label('phone', trans('Phone') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('phone', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('phone', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                </div>

                <hr/>

                <h3>Doručovací adresa</h3>

                <div class="row">

                    <!-- Company Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('company') ? 'has-error' : '' }}">
                        {!! Form::label('company', trans('Company') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('company', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('company', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <!-- Street Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('street') ? 'has-error' : '' }}">
                        {!! Form::label('street', trans('Street') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('street', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('street', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <!-- City Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('city') ? 'has-error' : '' }}">
                        {!! Form::label('city', trans('City') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('city', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('city', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                    <!-- Postcode Form Input -->

                    <div class="form-group col-sm-3 {{ $errors->has('postcode') ? 'has-error' : '' }}">
                        {!! Form::label('postcode', trans('Postcode') . ':') !!}

                        <div class="form-relative">
                            {!! $errors->first('postcode', '<div class="form-error">:message</div>') !!}

                            {!! Form::text('postcode', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>

                </div>

                <hr/>

                <div class="form-group no-margin-bottom">
                    <div class="checkbox">
                        {!! Form::checkbox( 'billing_address', 1, (!is_null($order->billingAddress)), ['id'=>'billing_address']) !!}
                        {!! Form::label('billing_address', trans('Chci zadat rozdílnou fakturační adresu')) !!}
                    </div>
                </div>

                <hr/>


                <div class="billing-address" @if( is_null($order->billingAddress) ) style="display: none;" @endif>

                    <div class="row">

                        <!-- Billing_company Form Input -->

                        <div class="form-group col-sm-3 {{ $errors->has('billing_company') ? 'has-error' : '' }}">
                            {!! Form::label('billing_company', trans('Billing_company') . ':') !!}

                            <div class="form-relative">
                                {!! $errors->first('billing_company', '<div class="form-error">:message</div>') !!}

                                {!! Form::text('billing_company', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>

                        <!-- Billing_street Form Input -->

                        <div class="form-group col-sm-3 {{ $errors->has('billing_street') ? 'has-error' : '' }}">
                            {!! Form::label('billing_street', trans('Billing_street') . ':') !!}

                            <div class="form-relative">
                                {!! $errors->first('billing_street', '<div class="form-error">:message</div>') !!}

                                {!! Form::text('billing_street', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>

                        <!-- Billing_city Form Input -->

                        <div class="form-group col-sm-3 {{ $errors->has('billing_city') ? 'has-error' : '' }}">
                            {!! Form::label('billing_city', trans('Billing_city') . ':') !!}

                            <div class="form-relative">
                                {!! $errors->first('billing_city', '<div class="form-error">:message</div>') !!}

                                {!! Form::text('billing_city', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>

                        <!-- Postcode Form Input -->

                        <div class="form-group col-sm-3 {{ $errors->has('billing_postcode') ? 'has-error' : '' }}">
                            {!! Form::label('billing_postcode', trans('Postcode') . ':') !!}

                            <div class="form-relative">
                                {!! $errors->first('billing_postcode', '<div class="form-error">:message</div>') !!}

                                {!! Form::text('billing_postcode', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!-- Billing_VAT Form Input -->

                        <div class="form-group col-sm-3 {{ $errors->has('billing_VAT') ? 'has-error' : '' }}">
                            {!! Form::label('billing_VAT', trans('Billing_VAT') . ':') !!}

                            <div class="form-relative">
                                {!! $errors->first('billing_VAT', '<div class="form-error">:message</div>') !!}

                                {!! Form::text('billing_VAT', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>

                    </div>

                    <hr/>
                </div>

                <div>
                    <a class="btn btn-default" href="{{ route('cart.show') }}">{{ trans('common.Back to cart') }}</a>

                    {!! Form::button(trans('common.Continue'), ['type' => 'submit', 'class' => 'btn btn-success pull-right']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
