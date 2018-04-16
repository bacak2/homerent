@extends ('pages.results')
@section ('displayResults')
            <div class="row">
                <div class="col-10"><h1 style="font-size: 32px" class="pb-2">{{__('messages.not found apartaments')}}</h1></div>
                <div class="col-10"><h2 style="font-size: 28px">{{ __('messages.not found change criteria') }}</h2></div>
                <div style='height: 80px'></div>
                <div class="col-10"><h3 class="pb-2" style='font-size: 20px; color: #045ff2'>{{__('messages.not found see others')}}</h3></div>
                
            </div>
@endsection