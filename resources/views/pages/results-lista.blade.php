@extends ('pages.results')
@section ('displayResults')
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