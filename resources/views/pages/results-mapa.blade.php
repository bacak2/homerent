@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-10"><h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}}</h3></div>
                <div class="col-2 inline-wrapper"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">Kafle</a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}">Lista</a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}"><b>Mapa</b></a> </div>
            </div>
		<div class="row">
			@foreach ($finds as $apartament)
		      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments/{{ $apartament->apartament_link }}">
		        <div style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover;"  class="apartament">
		        <p class="title">{{$apartament->apartament_name}}</p>

		      </div>
		      </a>
			@endforeach 	
		</div>

@endsection