@extends('site._layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-4">
            <h2 class="page-header text-center"> Aktivní Stories </h2>
            @if(count($boards) > 0)
                <ul class="list-group">
                    @foreach($boards as $board)
                        <li class="list-group-item text-center">
                            {{ $board->name }} – {{ $board->author->name }}
                            <a href="{{ route('poker-planning.show', [$board->slug]) }}" class="pull-right btn btn-xs btn-info" style="padding: 0 10px;">
                                <i class="fa fa-caret-right"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-gray text-thin text-center">
                    Žádná aktivní stories
                </div>
            @endif

        </div>
        <div class="col-sm-8">
            <div class="jumbotron">
                <h1 class="page-header text-center">
                    Vytvořte nový User Story
                </h1>
                <hr/>

                {!! Form::open(['url'=>route('poker-planning.add')]) !!}

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

