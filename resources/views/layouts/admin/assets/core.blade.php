@prepend('css')
	
	<link rel="stylesheet" href="{{ asset('libraries/bootstrap/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/bootstrap/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themes/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themes/flat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pedidos/mesa_scroll.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/pikaday/pikaday.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/manific-popup/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2022.1.119/styles/kendo.default-main.min.css" />
    


@endprepend

@prepend('libraries')
    
    <script src="https://kendo.cdn.telerik.com/2022.1.119/js/jquery.min.js"></script>
    <script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libraries/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('libraries/bootstrap/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('libraries/match-height/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('libraries/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('libraries/pikaday/moment.min.js') }}"></script>
    <script src="{{ asset('libraries/pikaday/pikaday.js') }}"></script>
    <script src="{{ asset('libraries/pikaday/pikaday.jquery.js') }}"></script>
    <script src="{{ asset('libraries/manific-popup/jquery.magnific-popup.min.js') }}"></script>


    
@endprepend

@include('layouts.admin.assets.libraries.kendo')
@include('layouts.admin.assets.libraries.datetime')
@include('layouts.admin.assets.libraries.jquery-validation')
@include('layouts.admin.assets.libraries.checkbox')
@include('layouts.admin.assets.libraries.select2')

@prepend('scripts')
    <script src="{{ asset('js/modules/pedidos/index.js') }}"></script>
	<script src="{{ asset('js/custom/app.js') }}"></script>
    <script src="{{ asset('js/custom/alert-functions.js') }}"></script>
    <script src="{{ asset('js/custom/functions.js') }}"></script>
    <script src="{{ asset('js/modules/pedidos/mesa_scroll.js') }}"></script>
    <script src="{{ asset('js/modules/pedidos/edit_pedidos.js') }}"></script>
@endprepend