<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name', 'Ir21-Roaming') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href=""/>

    @include('layouts.admin.assets.core')

    <!-- CSS App -->
    
    @stack('css')

</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    @include('layouts.admin.nav')
                </div>
            </nav>
            <div class="side-menu sidebar-default">
                @include('layouts.admin.sidebar')
            </div>

            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    @yield('content')
                </div>
            </div>

        </div>

        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right">0.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © {{ Carbon::now()->format('Y') }} Copyright.
            </div>
        </footer>

    </div>

    <!-- Libraries -->

    @stack('libraries')

    <!-- Global Variables -->
    @stack('scripts')

</body>

</html>
