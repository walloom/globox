<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="URL_BASE_2" content="https://globox.tech">
        <meta name="URL_BASE" content="{{ env('APP_ENV')==='production'? 'https://globox.tech' : url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GLOBOX</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icons/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('img/icons/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('img/icons/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">


        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
        <link href="{{ asset('css/app.css?v='.config('app.version') ) }}" rel="stylesheet">

        @stack('css')


        @auth()
        @if (Auth::user()->company)
        <link href="{{ asset('storage/companies') }}/{{ Auth::user()->company->id }}/css/company.css" rel="stylesheet">
        @endif
        @endauth  

    </head>
    <body class="hold-transition sidebar-mini">
        @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            @if (Auth::user()->company)
            <input type="text" id="colorPrimaryCompany" value="{{ Auth::user()->company->primary }}">
            <input type="text" id="colorSecondaryCompany" value="{{ Auth::user()->company->secondary }}">
            @endif
        </form>
        @include('layouts.page_templates.auth')
        @endauth
        @guest()
        @include('layouts.page_templates.guest')
        @endguest

    <x-modal></x-modal>
    <x-modal-lg></x-modal-lg>

    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="{{ asset('js/app.js?v='.config('app.version') ) }}"></script>

    @stack('js')

</body>
</html>
