@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-10"><h3 class="pb-2">{{__('messages.not found apartaments')}}</h3></div>
                <div class="col-10">{{ __('messages.not found change criteria') }}</div>
                <div style='height: 80px'></div>
                <div class="col-10"><h4 class="pb-2" style='color: #045ff2'>{{__('messages.not found see others')}}</h4></div>
                
            </div>
@endsection