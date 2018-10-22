@extends ('layout.layout')

@section('title', __('messages.Privacy policy') )

@section('content')
	<div class="container">
		<h1>{{ __('messages.Privacy policy of service') }}</h1>

		<span class="privacy-policy">{!! getPageContent('privacy-policy') !!}</span>

	</div>
@endsection