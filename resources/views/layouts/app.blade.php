<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#############">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/site.webmanifest">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#002859">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#00ff99">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#00ff99">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('webpage.title') {{ config('app.name', 'Team Spark') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app" class="font-body text-secondary">
    <!-- Navbar -->
@include('layouts.nav')
<!-- Content -->
    <div id="content" class="mt-32">
        @yield('content')
    </div>

</div>

<!-- Footer -->
@include('layouts.footer')

<!-- CookieDisclaimer -->
@include('layouts.cookie')

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@yield('webpage.scripts')
</body>

</html>
