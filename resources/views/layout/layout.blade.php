<!DOCTYPE html>
<html>
<head>
	<title>Homerent @yield('title')</title>
	{{-- CSS --}}
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/forms.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('ism/css/my-slider.css') }}" rel="stylesheet">
	{{-- JS --}}
	<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	{{-- JQUERYUI PLUGIN --}}
	<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="{{asset('js/datepicker-pl.js')}}"></script>
	{{-- ISM SLIDEBAR PLUGIN --}}
	<script type="text/javascript" src="{{ asset('ism/js/ism-2.2.min.js') }}"></script>
	{{-- FOTORAMA PLUGIN --}}
	<script type="text/javascript" src="{{ asset('js/fotorama.js') }}"></script>
	<link href="{{ asset('css/fotorama.css') }}" rel="stylesheet">
	{{-- AUTOCOMPLETE PLUGIN --}}
	<!-- JS file -->
	<script src="{{ asset('node_modules/easy-autocomplete/dist/jquery.easy-autocomplete.min.js')}}"></script> 

	<!-- CSS file -->
	<link rel="stylesheet" href="{{ asset('node_modules/easy-autocomplete/dist/easy-autocomplete.min.css')}}"> 

	<!-- Additional CSS Themes file - not required-->
	<link rel="stylesheet" href="{{ asset('node_modules/easy-autocomplete/dist/easy-autocomplete.themes.min.css') }}"> 

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