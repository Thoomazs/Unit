<!-- Basic Page Needs
   ================================================== -->
<meta charset="utf-8"/>
<title>
    @section('title')
        Admin
    @show
</title>

<meta name="keywords" content="your, awesome, keywords, here"/>
<meta name="author" content="Tomáš Novotný, Cynet.cz"/>
<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />


<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{ asset("css/vendor.css") }}"/>
<link rel="stylesheet" href="{{ elixir("css/admin.css") }}"/>

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

<!-- JS
================================================== -->
<script type="text/javascript" src="{{ asset("js/vendor.js") }}"></script>
<script type="text/javascript" src="{{ elixir("js/admin.js") }}"></script>