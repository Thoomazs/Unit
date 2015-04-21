@extends('site._layouts.master')

@section('content')


    RETRO name: {{ $board->name }}, author {{ $board->author->name }} <br /><br />


    <div class="col-md-1">
        <a @if($buttonColor->value == 1) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif  href="{{ route('poker-planning.vote', [$board->slug, 1]) }}">0</a>
        <a @if($buttonColor->value == 8)class="btn btn-primary btn-block" @else class="btn btn-primary btn-block"  @endif  href="{{ route('poker-planning.vote', [$board->slug, 8]) }}">13</a><br />
        <a class="btn btn-default">Jsem ready!</a>

    </div>
    <div class="col-md-1">
        <a @if($buttonColor->value == 2) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 2]) }}">1/2</a>
        <a @if($buttonColor->value == 9) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 9]) }}">20</a>
    </div>
    <div class="col-md-1">
        <a @if($buttonColor->value == 3) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 3]) }}">1</a>
        <a @if($buttonColor->value == 10) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 10]) }}">40</a>
    </div>
    <div class="col-md-1">
        <a @if($buttonColor->value == 4) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 4]) }}">2</a>
        <a @if($buttonColor->value == 11) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 11]) }}">100</a>
    </div>
    <div class="col-md-1">
        <a @if($buttonColor->value == 5) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 5]) }}">3</a>
        <a @if($buttonColor->value == 12) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 12]) }}">?</a>
    </div>
    <div class="col-md-1">
        <a @if($buttonColor->value == 7) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 7]) }}">8</a>
    </div>

    <div class="col-md-1">
        <a @if($buttonColor->value == 13) class="btn btn-danger btn-block" @else class="btn btn-primary btn-block"  @endif href="{{ route('poker-planning.vote', [$board->slug, 13]) }}">C</a>
    </div>





@stop
