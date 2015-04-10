@extends('site._layouts.master')

@section('content')

    <div id="login">

        <div class="col-sm-6 col-sm-offset-3">

            <div class="box">

                <h2 class="form-header">{{ trans('common.Login') }}</h2>

                {!! form_start($form) !!}

                {!! form_row($form->email) !!}

                {!! form_row($form->password) !!}

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! form_row($form->remember) !!}
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route("password.email") }}" class="pull-right btn btn-default btn-sm"> {{ trans("common.Forget password") }}</a>
                        </div>
                    </div>
                </div>

                {!! form_end($form) !!}

            </div>
        </div>
    </div>
@stop
