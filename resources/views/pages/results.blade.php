@extends ('layout.layout')
@section('title', '- Wyszukiwarka')
@section('content')
<div class="container pt-5 pb-5 results-search">
<div class="col">

    @include('includes.search-form-results')
</div>
</div>
	<div class="container" id="apartamentsforyou">

                @yield('displayResults')
	</div>
<div id="lang" style="display: none;">
        {{ App::getLocale() }}
</div>
<script type="text/javascript" src="{{ URL::asset('js/search.js') }}"></script>

@endsection