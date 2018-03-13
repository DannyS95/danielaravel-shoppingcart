<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body>
        @include('partials.header')

        <div class="container">
            @yield('content')
        </div>

        @yield('scripts')



        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>

</html>