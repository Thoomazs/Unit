@extends('site._layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="jumbotron">
                <h1 class="page-header text-center">
                    Vytvořte nový Sprint
                </h1>
                <hr/>

                {!! Form::open(['url'=>route('retrospective.add')]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <div class="form-relative">
                        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

                        {!! Form::text('name', null, ['class' => 'form-control input-lg', 'autocomplete' => 'off', 'placeholder' => 'Název']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::button('Vytvořit', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
