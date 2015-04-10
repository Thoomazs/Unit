<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8"/>
<title>
    @section('title')
        Laravel 5 App
    @show
</title>
<meta name="keywords" content="your, awesome, keywords, here"/>
<meta name="author" content="Tomáš Novotný, Cynet.cz"/>
<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
{{--<link rel="stylesheet" href="{{ elixir("css/all.min.css") }}"/>--}}

<link rel="stylesheet" href="{{ asset("css/vendor.css") }}"/>
<link rel="stylesheet" href="{{ elixir("css/app.css") }}"/>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

<!-- JS
================================================== -->
<script type="text/javascript" src="{{ asset("js/vendor.js") }}"></script>
<script type="text/javascript" src="{{ elixir("js/app.js") }}"></script>

