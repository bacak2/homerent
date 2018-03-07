@extends ('includes.reservations')

@section('reservation.content')
<div class="container flex-box">
    <div id="Rtitle"><h4><b>1. {{ __('messages.offer') }}</b></h4></div>
    <div id="Rpath"><span class="active">{{ __('messages.offer') }}</span> - {{ __('messages.your data') }} - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</div>
</div>
<div class="container">
    <div class="row reservation-item py-2">
        <div class="col-lg-2 mobile-none">
            <div class="apartament " style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; margin-bottom: 0px; width: 180px; height: 110px;">
            </div>
        </div>
        <div class="col-lg-10 col-sm-12">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <div class="txt-blue" style="font-size: 22px"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                    <div class="mb-2">{{ $apartament->apartament_address }}</div>
                    <div>
                    <span>
                        @for ($i = 0; $i < 5; $i++)
                            <img class="list-item" src='{{ asset("images/results/star_list.png") }}'>
                        @endfor
                    </span>
                    </div>
                    <div>
                        <span style="color: green; letter-spacing: -1px;"><b>8,3/10</b> <span style="font-size: 14px">{{ __("messages.Perfect") }}</span></span> <span style="color: blue; font-size: 10px">55 {{ __("messages.reviews_number") }}</span>
                    </div>
                    <div class="res-description">
                        {{ __('messages.res.firstStepDescription') }}
                    </div>
                    <hr class="desktop-none">
                </div>
                <div class="col-lg-7 col-sm-6">
                    <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>sob, 26 kwiecień 2014 (po 15:00)</b></div></div>
                    <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>sob, 26 kwiecień 2014 (po 15:00)</b></div></div>
                    <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">2</div></div>
                    <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">2</div></div>
                    <div class="res-description txt-blue mt-3">
                        {{ __('messages.change') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <p><b>{{ __('messages.Payment') }}</b></p>
                    <button class="btn btn-reservation selected mr-2">{{ __('messages.Non-refundable offer') }}</button>
                    <button class="btn btn-reservation">{{ __('messages.Refundable offer') }}</button>
                    <p id="payment-description" style="display: none">
                        {{ __('messages.res.paymentDescription') }}
                    </p>
                    <div class="pl-lg-4">
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">200,00 PLN</span></div></div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                        <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                        <div class="row mb-3"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>50,00 PLN</b></span></div></div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <b>{{ __('messages.Contact details') }}</b>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <b>{{ __('messages.Additional services') }}</b>
                </div>
                <div class="col-12 mt-3">
                    <p><b>{{ __('messages.Message for the owner about services') }}</b></p>
                    <label for="res-ph">{{ __('messages.Content') }}:</label><textarea id="res-ph" class="ml-4" rows="4" cols="50" style="width: 80%" placeholder="{{ __('messages.res.Placeholder1') }}"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <a href="{{ url()->previous() }}" class="btn btn-link ml-2" onclick="return confirm(' {{ __("messages.return confirmation") }} ')">{{ __('messages.Return') }}</a>
            </div>
            <div class="col-lg-3 col-sm-12">
                <a href="/reservations-second-step/{{ $apartament->descriptions[0]->apartament_link }}" class="btn ml-2 pointer">{{ __('messages.next') }}</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-reservation').click(function(){
        $('.btn-reservation').toggleClass('selected');
        $('#payment-description').toggle();
    });

</script>
@endsection()