<nav class="navbar">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-collapse">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{{ route('admin') }}}">
            ADMIN
        </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            @section('nav')

                <li class="dropdown {{ ( controller() == 'User' ? 'active' : '' ) }}">
                    <a href="{{ route('admin.users.index') }}" class="dropdown-toggle">
                        {{ trans('common.Users') }}
                    </a>
                </li>
                <li class="{{ (  controller() == 'Product' ? 'active' : '' ) }}">
                    <a href="{{ route('admin.products.index') }}">{{ trans('common.Products') }}</a>
                </li>
                <li class="{{ (  controller() == 'Category' ? 'active' : '' ) }}">
                    <a href="{{ route('admin.categories.index') }}">{{ trans('common.Categories') }}</a>
                </li>

            @show
        </ul>

        <ul class="nav navbar-nav pull-right">
            <li class="{{ (  controller() == 'Log' ? 'active' : '' ) }}">
                <a href="{{ route('admin.log.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('common.Log') }}">
                    <i class="fa fa-archive hidden-xs"></i><span class="visible-xs">Log</span>
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('common.Go to Site') }}">
                    <i class="fa fa-home hidden-xs"></i><span class="visible-xs">Go To Site</span></a>
            </li>
            <li>
                <a href="{{ route('auth.logout') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('common.Logout') }}">
                    <i class="fa fa-sign-out hidden-xs"></i><span class="visible-xs">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

