@extends ('pages.results')
@section ('displayResults')

    <div class="row desktop-none" style="margin-bottom: 20px">
        <div class="col-9 text-mobile-search">
            <a href="{{ route('index') }}" style="color: #00afea">Start > </a><b>{{ $finds[0]->apartament_city ?? ''}}</b>, {{__('messages.from')}} {{ $_GET['przyjazd'] }}, {{__('messages.number of nights')}}: {{ $nightsCounter }}, {{__('messages.Persons')}}: {{ $_GET['dorosli']+$_GET['dzieci'] }} {{--__('messages.Filters')--}}
        </div>
        <div class="col-3">
            <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
        </div>
        @mobile
            @include('includes.filters-mobile')
        @endmobile
    </div>

    </form>
            <div class="row">
                <div class="col-10"><h1 style="font-size: 32px" class="pb-2">{{__('messages.not found apartaments')}}</h1></div>
                <div class="col-10"><h2 style="font-size: 28px">{{ __('messages.not found change criteria') }}</h2></div>
                <div style='height: 80px'></div>
                <div class="col-10"><h3 class="pb-2" style='font-size: 20px; color: #045ff2'>{{__('messages.not found see others')}}</h3></div>
                
            </div>
@endsection