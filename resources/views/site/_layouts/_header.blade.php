<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-collapse">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('/img/CN_Group_logo.png') }}" alt="logo"/>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="header-collapse">

            <ul class="nav navbar-nav">
                <li class="{{ ( Request::url() == route('retrospective.index') ? ' active' : '') }}">
                    <a href="{{ route('retrospective.index') }}">Retrospectiva</a>
                </li>
                <li class="{{ ( Request::url() == route('poker-planning.index') ? ' active' : '') }}">
                    <a href="{{ route('poker-planning.index') }}">Poker Planning</a>
                </li>
                <li>
                    <a href="/">Brainstorming</a>
                </li>
                <li>
                    <a href="/">Daily Standup</a>
                </li>
                <li class="{{ ( Request::url() == route('pages.help') ? ' active' : '') }}">
                    <a href="{{ route('pages.help') }}">Help</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @section('nav-right')

                    @if (Auth::check())

                        @if( Auth::user()->hasRole('Admin') )
                            <li>
                                <a href="{{ route('admin') }}">{{ trans('common.Admin') }}</a>
                            </li>
                        @endif

                        <li class="{{ ( Request::url() == route('my-account.profile') ? ' active' : '') }}">
                            <a href="{{ route('my-account.profile') }}">{{ Auth::user()->name }}</a>
                        </li>
                        <li>
                            <a href="{{ route('auth.logout') }}">{{ trans('common.Logout') }}</a>
                        </li>
                    @else
                        <li class="{{ ( Request::url() == route('auth.login') ? ' active' : '') }}">
                            <a href="{{ route('auth.login') }}">{{ trans('common.Login') }}</a>
                        </li>
                        <li class="{{ ( Request::url() == route('auth.register') ? ' active' : '') }}">
                            <a href="{{ route('auth.register') }}">{{ trans('common.Register') }}</a>
                        </li>
                    @endif

                @show
            </ul>
        </div>
    </div>
</nav>