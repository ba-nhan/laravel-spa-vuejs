<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>@yield('title', 'Trang chủ')</title> -->
    <!-- <title> @{{ $route.meta.title }}</title> -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/material-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('font/Gotham/Gotham.css')}}">
    <link rel="stylesheet" href="{{asset('font/platform/platform.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/Stethoscope.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/materialize.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>   
    <script src="{{asset('js/bootstrap3-typeahead.min.js')}}"></script>         
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
</head>
<body>
<div id="app">
    <index></index> 
</div>
<script type="text/javascript">
    
</script>
</body>
</html>