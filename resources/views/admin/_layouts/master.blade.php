<!DOCTYPE html>
<html id="admin" lang="cs">
<head>
    @include('admin._layouts._head')
</head>
<body class="{{ str_replace('.','-',Route::currentRouteName()) }}">


<header id="header">
    @include('admin._layouts._header')
</header>


<div id="main">
    <div class="container">

        <div id="breadcrumbs">
            @section('breadcrumbs')
                @include("templates.breadcrumbs", ["render" => 'admin'])
            @show
        </div>

        @include('templates.messages')

        <div>
            @yield('content')
        </div>

    </div>

</body>
</html>