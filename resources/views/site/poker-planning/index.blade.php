@extends('site._layouts.master')

@section('content')

    POKER

    {!! Form::open(['url'=>route('poker-planning.add')]) !!}

    <div class="row">
        <div class="col-sm-8">
            <!-- Name Form Input -->

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <div class="form-relative">
                    {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

                    {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">

            <!-- Common.Add new Board Form Submit -->
a
            <div class="form-group">
                {!! Form::button(trans('common.Add new Board'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) !!}
            </div>
        </div>
    </div>




    {!! Form::close() !!}

    <hr/>


    <ul class="list-group">
        @foreach($boards as $board)
        <li class="list-group-item">
            <a href="{{ route('poker-planning.show', [$board->slug]) }}">
                {{ $board->name }}
            </a>
        </li>
        @endforeach
    </ul>

@stop
