<!DOCTYPE html>

<html lang="cs">
<head>
    @include('site._layouts._head')
</head>
<body>
<div id="wrapper">
    @include('templates.messages')

    <header id="header">
        @include('site._layouts._header')
    </header>

    <div id="content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <footer id="footer" class="row">
        @include('site._layouts._footer')
    </footer>
</div>
</body>
</html>