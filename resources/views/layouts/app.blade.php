<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ir21-Roaming') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('libraries/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="{{ asset('libraries/font-awesome/css/font-awesome.min.css') }}">
    @yield('captcha')
    <!-- Scripts -->
    <script>
        window.Laravel = <?= json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top fondo-color">
        
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <div class="col-md-12 col-sx-8">
                    <h4 class="centrar titulo"></h4>               
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>
