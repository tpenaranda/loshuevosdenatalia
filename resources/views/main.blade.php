<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" style="overflow-x: hidden">
        <div class="md-layout md-gutter">
            <div class="md-layout-item px-0"></div>
            <div class="md-layout-item md-size-40 md-small-size-60 md-xsmall-size-100 md-elevation-4 px-0 mt-md-2 mt-sm-2">
                <header-component></header-component>
                <top-component></top-component>
                <main-component></main-component>
            </div>
            <div class="md-layout-item px-0"></div>
        </div>
        <div class="md-layout md-gutter">
            <div class="md-layout-item pt-2">
                <div class="md-caption" align="center">
                    <p>Made with <span class="text-danger">❤</span> at Rosario</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
