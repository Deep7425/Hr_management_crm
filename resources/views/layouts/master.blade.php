<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />
    @include('layouts.head')
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <title>{{ (isset($page_title) ? $page_title.' - ':'').config('app.name', 'Laravel') }} | Admin</title>
</head>
<body class="bg-theme bg-theme1">

    <div class="wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')

        <div class="container-fluid">
            @yield('content')
            @include('layouts.theme-swicher')
        </div>
        
        <footer class="footer">
            @include('layouts.footer')
        </footer>
    </div>
    @include('layouts.footer-script')
    @yield('script')
    
</body>
</html>
