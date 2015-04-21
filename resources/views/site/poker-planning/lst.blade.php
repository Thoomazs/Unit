@extends('site._layouts.master')

@section('content')

    {{  @dump($users) }}

    {{--@foreach($users as $user)--}}
        {{--{{ $user->name  }}--}}
    {{--@endforeach--}}

@stop