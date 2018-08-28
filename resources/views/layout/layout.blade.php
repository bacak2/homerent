<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
	{{-- CSS --}}
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/homerent.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/jquery-date-range-picker/src/daterangepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fotorama.css') }}" rel="stylesheet">
	<link href="{{ asset('css/t-datepicker.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/t-datepicker-main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="{{ asset('vendor/easy-autocomplete/dist/easy-autocomplete.min.css')}}"> 
	<link rel="stylesheet" href="{{ asset('vendor/easy-autocomplete/dist/easy-autocomplete.themes.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.print.css">
	{{-- JS --}}
	<script type="text/javascript" src="{{ asset('vendor/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jscroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('vendor/jquery-date-range-picker/dist/jquery.daterangepicker.min.js') }}"></script>--}}
	<script type="text/javascript" src="{{ asset('vendor/fotorama/fotorama.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/locale/pl.js"></script>
	<script type="text/javascript" src="https://apis.google.com/js/platform.js" async defer>{lang: 'pl'}</script>
	<script type="text/javascript" src="{{ asset('js/facebookConnection.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/t-datepicker.min.js') }}"></script>
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
	{{--Login popup--}}
	@include('includes.login-popup')
	{{--Sign-up popup--}}
	@include('includes.registration-popup')

	@auth
	{{--Clear-favourites popup--}}
	@include('account.favourites.clear-favourites')
	{{--Send-to-friends popup--}}
	@include('includes.send-to-friends')
	@endauth

	@yield('scripts')
</body>
</html>