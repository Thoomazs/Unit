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
        <div class="col-sm-10">
            <h1 class="page-header no-margin-top">
                Retrospektiva: <b>{{ $board->name }}</b> – <span class="text-gray text-italic text-light">{{ $board->author->name }}</span>
            </h1>

            <div class="row">
                <div class="col-sm-5">
                    <p> Tuto retrospektivu můžete sdílet pomocí odkazu</p>
                </div>
                <div class="col-sm-7">
                    <input class="form-control" id="add-link" type="text" value="{{ route('retrospective.join', $board->hash )}}" />
                </div>

               </div>

            <script type="text/javascript">
                $( function() {
                    $("#add-link" ).click( function() {
                        $(this).select();
                    })
                })
            </script>

            <hr/>

            <div class="row">
                <div class="col-sm-6">

                    @if( $boardUser->ready == false )
                        <div class="well">
                            {!! form_start($form) !!}
                            <div class="form-group">
                                {!! form_widget($form->text) !!}
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    {!! form_widget($form->type) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! form_widget($form->store) !!}
                                </div>
                            </div>
                            {!! form_end($form) !!}
                        </div>

                    @endif

                    <h2>Moje příspěvky</h2>

                    <ul>
                        @foreach($postIts as $postIt)
                            <li class="post-it">

                                <div class="controls">
                                    <span>{{ $postIt->type }} – </span>

                                    @if( $boardUser->ready )
                                        <a href="{{ route('retrospective.postit.publish',$postIt->id) }}">
                                            <i class="fa fa-thumb-tack"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('retrospective.postit.delete',$postIt->id) }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    @endif
                                </div>

                                <p>{{ $postIt->text }}</p>

                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6">

                    @if( $boardUser->ready == false )
                        <a class="btn btn-success btn-block btn-lg" href="{{ route('retrospective.user.ready', $boardUser->id) }}">
                            I am ready
                        </a>
                    @else
                        <h2>Zveřejněné příspěvky</h2>
                        @foreach($visiblePostIts as $postIt)
                            <li class="post-it">

                                <div class="controls">
                                    <span>{{ $postIt->type }} – {{ $postIt->author->name }}</span>
                                </div>

                                <p>{{ $postIt->text }}</p>

                            </li>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
    </div>

@stop
