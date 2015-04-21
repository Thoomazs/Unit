@extends('site._layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="jumbotron">
                <h1 class="page-header text-center">
                    Připojte se k retrospektivě {{ $board->name }}
                </h1>
                <hr/>

                {!! Form::open(['url'=>route('retrospective.join')]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <div class="form-relative">
                        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

                        {!! Form::text('name', null, ['class' => 'form-control input-lg', 'maxlength' => 255, 'autocomplete' => 'off', 'placeholder' => 'Vaše jméno zobrazené v retrospektivě']) !!}

                        {!! Form::hidden('board_id', $board->id) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::button('Připojit se', ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
