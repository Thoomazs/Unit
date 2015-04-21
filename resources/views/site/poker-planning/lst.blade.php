@extends('site._layouts.master')

@section('content')


    @foreach($users as $users2)
        @foreach($users2->users as $user)
            {{ $user->name }} {{ $users2->value }} <br />
        @endforeach


    @endforeach

@stop