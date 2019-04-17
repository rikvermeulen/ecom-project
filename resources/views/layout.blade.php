<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle')</title>
    <meta name="" content="">
    <meta name="title" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta name="author" content="Rik Vermeulen">
    <link rel="author" href="humans.txt">

    <meta name="google" content="notranslate">
    <meta name="theme-color" content="#000">
    <meta name="generator" content="PHPStorm">

    <link rel="license" href="copyright.html">

    <!--social-->
    <meta property="og:url" content="">
    <meta property="og:type" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">

    <meta name="twitter:card" content="summary/description">
    <meta name="twitter:url" content="https://website.com">
    <meta name="twitter:title" content="Title of website">
    <meta name="twitter:description" content="description">

    <!--google-->
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="3 month" />

    <!--favicon-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('image/favicon.ico')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('image/favicon.ico')}}" />
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.ico')}}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.ico')}}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.ico')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.ico')}}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('image/favicon.ico')}}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('image/favicon.ico')}}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('image/favicon.ico')}}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('image/favicon.ico')}}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('image/favicon.ico')}}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('image/favicon.ico')}}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset ('/css/app.css')}}">
    <link rel="stylesheet" href="css/common/bootstrap.css">
</head>
<body>

@yield('content')

<script src="js/app.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>