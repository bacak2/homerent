@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-10"><h3 class="pb-2">{{__('messages.found')}} {{ $counted }} {{trans_choice('messages.apartaments',$counted)}}</h3></div>
                <div class="col-2 inline-wrapper"> <a class="btn btn-default" href="/search/kafle?{{ http_build_query(Request::except('page')) }}">Kafle</a> <a class="btn btn-default" href="/search/lista?{{ http_build_query(Request::except('page')) }}"><b>Lista</b></a> <a class="btn btn-default" href="/search/mapa?{{ http_build_query(Request::except('page')) }}">Mapa</a> </div>
            </div>
            @foreach ($finds as $apartament)
		<div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-6 col-xl-3">
                        <a href="/apartaments/{{ $apartament->apartament_link }}">
                            <img style="height: auto; width: 100%; max-width: 255px; max-height: 144px" src="{{ asset("images/apartaments/$apartament->id/1.jpg") }}">
                        </a>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="container py-1 font-weight-bold"><h4>{{ $apartament->apartament_name }}</h4></div>
                        </div>
                        <div class="row">
                            <div class="container py-1">{{ $apartament->apartament_address }}</div>
                        </div>
                        <div class="row">
                            <div class="container py-1">{{ substr($apartament->apartament_description, 0, 250) }}...</div>
                        </div>
                       
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="row">
                            <div class="container py-1 text-right font-weight-bold"><h3>od 122 zł</h3></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.book') }}</a></div>
                        </div>
                        <div class="row">
                            <div class="container py-1" ><a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary ml-2" style="width: 100%">{{ __('messages.see details') }}</a></div>
                        </div>
                    </div>
		</div>
            @endforeach
            
            {{ $finds->appends(['dorosli' => $request->dorosli, 'dzieci' => $request->dzieci, 'powrot' => $request->powrot, 'przyjazd' => $request->przyjazd, 'region' => $request->region])->links() }}

@endsection