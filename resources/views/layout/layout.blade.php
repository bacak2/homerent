<!DOCTYPE html>
<html>
<head>
	<title>Homent @yield('title')</title>
	{{-- CSS --}}
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">



	<link href="{{ asset('css/homerent.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/jquery-date-range-picker/src/daterangepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fotorama.css') }}" rel="stylesheet">
	{{-- JS --}}
	<script type="text/javascript" src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/jquery-date-range-picker/dist/jquery.daterangepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/fotorama/fotorama.js') }}"></script>
	{{-- JS AUTOCOMPLETE --}}
    <script src="{{ asset('vendor/easy-autocomplete/dist/jquery.easy-autocomplete.min.js')}}"></script> 
	<link rel="stylesheet" href="{{ asset('vendor/easy-autocomplete/dist/easy-autocomplete.min.css')}}"> 
	<link rel="stylesheet" href="{{ asset('vendor/easy-autocomplete/dist/easy-autocomplete.themes.min.css') }}"> 

<body>
	{{-- HEADER --}}
	@include('includes.header')
		{{-- CONTENT --}}
		@yield('content')
	{{-- FOOTER --}}
	@include('includes.footer')
	{{-- PRIVACY POLICY--}}
	@include('includes.privacy')

</body>
</html>