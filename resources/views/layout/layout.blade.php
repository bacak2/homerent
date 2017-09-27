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
	<script type="text/javascript" src="{{ asset('ism/js/ism-2.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.easyModal.js') }}"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	{{-- FOTORAMA PLUGIN --}}
	<script type="text/javascript" src="{{ asset('js/fotorama.js') }}"></script>
	<link href="{{ asset('css/fotorama.css') }}" rel="stylesheet">

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