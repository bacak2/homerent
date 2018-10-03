<div class="container" id="benifits">
 <div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="row">
            <div class="col-3 col-md-4 pr-1"><img class="img-fluid" src="{{ asset('images/procent.png') }}" alt="{{ __('messages.cheap') }}"></div>
            <div class="col-9 col-md-8 pl-0 pr-1"><h2 style="font-size:  20px;">{{ __('messages.cheap') }}</h2><p>{{ __('messages.cheapExp') }}</p></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="row">
            <div class="col-3 col-md-4 pr-1"><img class="img-fluid" src="{{ asset('images/time.png') }}" alt="{{ __('messages.fast') }}"></div>
            <div class="col-9 col-md-8 pl-0 pr-1"><h2 style="font-size:  20px;">{{ __('messages.fast') }}</h2><p>{{ __('messages.fastExp') }}</p></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="row">
            <div class="col-3 col-md-4 pr-1"><img class="img-fluid" src="{{ asset('images/up.png') }}" alt="{{ __('messages.safe') }}"></div>
            <div class="col-9 col-md-8 pl-0 pr-1"><h2 style="font-size:  20px;">{{ __('messages.safe') }}</h2><p>{{ __('messages.safeExp') }} {{ countAllReservations() }} {{ __('messages.safeExp2') }} {{ countAllOpinions() }} {{ __('messages.safeExp3') }}</p></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="row">
            <div class="col-3 col-md-4 pr-1"><img class="img-fluid" src="{{ asset('images/Call_72.png') }}" alt="{{ __('messages.professional') }}"></div>
            <div class="col-9 col-md-8 pl-0 pr-1"><h2 style="font-size:  20px;">{{ __('messages.professional') }}</h2><p>{{ __('messages.professionalExp') }}</p></div>
        </div>
    </div>
</div> 
</div>