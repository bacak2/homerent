@extends ('layout.layout')
@section('title', '- Wyszukiwarka')
@section('content')
<div class="container pt-5 pb-5 results-search">
<div class="col">
  <form class="wyszukiwarka" action="/search" method="GET" >
    <div class="form-row">
      <div class="col-md-3 mb-2 mb-sm-0">
        <input type="text" class="form-control" id="region" name="region" placeholder="{{ __('messages.forexample')}}" value="{{ $region }}" >
      </div>
      <div class="form-inline col-md-4 form-row pick-date ">
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="przyjazd" name="przyjazd" placeholder="{{ __('messages.arrive')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" value="{{ $arive_date }}" required>
              </div>
          </div>
          <div class="col-md-6 mb-2 mb-sm-0">
              <div class="input-group mb-2 mb-sm-0">
                  <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                  <input type="text" class="form-control" id="powrot" name="powrot" placeholder="{{ __('messages.return')}}" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" value="{{ $return_date }}" required>
              </div>
          </div>
      </div>
      <div class="col-md">
          <div class="input-group mb-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-male" aria-hidden="true"></i></div>
            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('messages.adults')}}">
          </div>
      </div>
      <div class="col-md">
        <div class="input-group mb-2 mb-sm-0">
          <div class="input-group-addon"><i class="fa fa-child" aria-hidden="true"></i></div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('messages.kids')}}">
        </div>
      </div>
      <div class="col-md">
        <button type="submit" class="btn btn-primary searchbtn">{{ __('messages.search') }}</button>
      </div>
    </div>
  </form>
</div>
</div>
	<div class="container" id="apartamentsforyou">
	<h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}} 
	</h3>



		<div class="row">
			@foreach ($finds as $apartament)
		      <a class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3" href="/apartaments/{{ $apartament->apartament_link }}">
		        <div style="background-image: url('{{ asset('images/1.jpg') }}');"  class="apartament">
		        <p class="title">{{$apartament->apartament_name}}</p>

		      </div>
		      </a>
			@endforeach 	
		</div>
	</div>
@endsection

