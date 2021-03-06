@extends('admin._layouts.master')

@section('title')
    Log index | @parent
@stop

@section('breadcrumbs')
    @include("templates.breadcrumbs", ["render" => 'log'])
@stop


@section('content')


    <div class="controls">
        <div class="row">
            <div class="col-sm-4">
                {!! Form::open(['method' => 'GET']) !!}
                <div class="input-group">
                    {!! Form::text('s', Input::get('s'), [ 'class' => 'form-control', 'autofocus' => 'true' ] ) !!}

                        <span class="input-group-btn">
                            {!! Form::submit(trans('common.Search'), [ 'class' => 'btn btn-success pull-right' ]) !!}
                        </span>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-8">
                <div class="pull-right">
                    @include("templates.pagination", ["paginator" => $logs, "type" => "simple"])
                </div>
            </div>
        </div>
    </div>


    <div class="table-responsive">

        <table class="table table-condensed table-bordered table-responsive table-striped table-hover no-margin-bottom">
            <thead>
            <tr>
                <th class="id"><i class="fa fa-dot-circle-o"></i></th>
                <th class="id">{{ trans('common.ID') }}</th>
                <th>{{ trans('common.Level') }}</th>
                <th>{{ trans('common.Date') }}</th>
                <th>{{ trans('common.User') }}</th>
                <th>{{ trans('common.Message') }}</th>
                <th>{{ trans('common.IP') }}</th>
            </tr>
            </thead>
            <tbody>

            @if( count( $logs) > 0)
                @foreach($logs as $log)
                    <tr data-log="true" class="{{ $log->class }}">
                        <td class="id text-center">
                            <i class="fa {{ $log->icon }}"></i>
                        </td>
                        <td class="id">
                            {{ $log->id }}
                        </td>
                        <td>
                            {{ $log->level }}
                        </td>
                        <td>
                            {{ $log->created_at }}
                        </td>
                        <td>
                            @if( $log->user )
                                <a href="{{ URL::route('admin.users.edit', $log->user->id) }}">
                                    {{ $log->user->name }}
                                </a>
                            @else
                                <span class="muted">–</span>
                            @endif
                        </td>
                        <td class="message">
                            <small>{{{ $log->message }}}</small>
                        </td>
                        <td>
                            {{ $log->ip }}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="99" class="end">
                        {{ trans('common.No records were found') }}
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>


    @if( count( $logs) > 0)
        <div class="controls overflow-hidden">
            <div class="pull-right">
                @include("templates.pagination", ["paginator" => $logs])
            </div>
        </div>
    @endif

    <script type="text/javascript">
        $( function() {
            var $body = $( "body.admin-log-index" );

            $body.find( ".table tr" ).on( "click", function() {
                var $tr = $( this ).closest( "tr" );
                if ( $tr.hasClass( "open" ) )
                    $tr.removeClass( "open" );
                else
                    $tr.addClass( "open" );
            } );
        } )
    </script>

@stop

