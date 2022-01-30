@push('css')
	
    <link rel="stylesheet" href="{{ asset('libraries/kendo/css/kendo.common-material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libraries/kendo/css/kendo.material.min.css') }}">

@endpush

@push('libraries')

    <script src="{{ asset('libraries/kendo/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('libraries/kendo/js/kendo.culture.es-ES.min.js') }}"></script>

@endpush

@push('scripts')
	
	<script src="{{ asset('js/custom/kendo-functions.js') }}"></script>
	
@endpush
