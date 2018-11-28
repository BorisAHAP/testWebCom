<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>{{ config('app.name', 'Laravel') }}</title>

   @include('layouts.meta_tags')
    <link rel="icon" href="{{asset('image/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('image/favicon.ico')}}"/>
    @include('layouts.header_css')
</head>
<body class="">
<div class="page">
    <div class="page-main">
        @include('layouts.header')
        @include('layouts.nav_menu')
        <div class="my-3 my-md-5">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@include('layouts.footer_js')
</body>
</html>