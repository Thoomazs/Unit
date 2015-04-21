@extends('site._layouts.master')

@section('content')


    <div class="row">
        <div class="col-sm-2">
            <ul class="list-group">
                @foreach($board->users as $user)
                    <li class="list-group-item">
                        <span class="badge badge-success"> <i class="fa fa-check"></i></span>
                        {{ $user->name }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-8">
            <h1 class="page-header">
                Retrospektiva: <b>{{ $board->name }}</b> – <span class="text-gray text-italic text-light">{{ $board->author->name }}</span>
            </h1>

            @if( ! $board->hasUser(Auth::user()->id))
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            {!! Form::open(['url'=>route('board.add-user')]) !!}

                            {!! Form::hidden('board_id', $board->id) !!}
                            {!! Form::button('<i class="fa fa-user-plus"></i> Přidat se', ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well">
                            {!! form($form) !!}
                        </div>

                        <ul>
                            @foreach($postIts as $postIt)
                                <li class="well">
                                    <b>{{ $postIt->type }}</b>
                                    {{ $postIt->text }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-success btn-block" href="{{ route('retrospective.done') }}">
                            Hotovo
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>



@stop
