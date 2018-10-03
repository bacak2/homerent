<div class="row">
    @foreach ($apartmentsNearby as $apartament)
        <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <div class="map-img-wrapper">

                <div class="apartament" style="height: 180px; background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                    <div class="map-see-more mobile-none">
                        <div class="container py-1">
                            <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                        </div>
                    </div>
                    <div class="desktop-none" style="width: 100%; height: 100%">
                        <a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
                    </div>
                </div>
                <div class="add-to-favourities" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Add to favorites') }}"><a href="#"><img src='{{ asset("images/results/heart.png") }}'></a></div>
                <div class="map-description-top">{{ $apartament->min_price }} PLN</div>
                <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div>
                <div class="description-bottom-right d-none d-sm-inline-block">
                    @for ($i = 0; $i < floor($apartament->ratingAvg/2); $i++)
                        <img src='{{ asset("images/results/star.png") }}'>
                    @endfor
                    @if(floor($apartament->ratingAvg/2) != ceil($apartament->ratingAvg/2))
                        <img src='{{ asset("images/results/star_half.png") }}'>
                    @endif
                    @for ($i = ceil($apartament->ratingAvg/2); $i < 5; $i++)
                        <img src='{{ asset("images/results/star_empty.png") }}'>
                    @endfor
                    <br>
                    @if($apartament->ratingAvg < 1)
                        <span class="opinion-to-left" style="margin-right: 10px;"></span>
                    @elseif($apartament->ratingAvg < 2.5)
                        <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Awful") }}</span>
                    @elseif($apartament->ratingAvg < 4.5)
                        <span class="opinion-to-left txt-red" style="margin-right: 10px;">{{ __("messages.Bad") }}</span>
                    @elseif($apartament->ratingAvg < 6.5)
                        <span class="opinion-to-left txt-yellow" style="margin-right: 10px;">{{ __("messages.Average") }}</span>
                    @elseif($apartament->ratingAvg < 8.5)
                        <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Very good") }}</span>
                    @else
                        <span class="opinion-to-left txt-green" style="margin-right: 10px;">{{ __("messages.Perfect") }}</span>
                    @endif

                    <span class="txt-blue nr-reviews-right">{{$apartament->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $apartament->opinionAmount ?? 0)}}</span>
                </div>
            </div>
            <div class="description-below">
                <span style="font-size: 17px">{{ $apartament->apartament_name }}</span>
                <span style="display:block; font-size: 11px">{{ $apartament->apartament_district }}</span>
                <span style="display:block; font-size: 11px">{{ $apartament->apartament_address }}</span>
                <div class="mt-2">
                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.people') }}" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.single beds') }}" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                    <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="{{ __('messages.Number of') }} {{ __('messages.double beds') }}" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                    @if ( $apartament->apartament_wifi == 1)
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Wifi" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                    @endif
                    @if ( $apartament->apartament_parking == 1)
                        <div class="description-below-img" data-toggle="tooltip" data-placement="bottom" title="Parking" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
                    @endif
                </div>
                <div class="description-map-bottom-right desktop-none">
                    @for ($i = 0; $i < 5; $i++)
                        <img src="{{ asset("images/results/star.png") }}">
                    @endfor
                    <br>
                    <span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span>
                    <span style="color: blue">55 {{ __("messages.reviews_number") }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>