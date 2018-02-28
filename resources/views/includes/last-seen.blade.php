    <div class="row">
        @foreach ($lastSeen as $apartament)
            <div style="overflow: auto;" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="map-img-wrapper">

                    <div class="apartament" style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; position: relative; margin-bottom: 0px">
                        <div class="map-see-more mobile-none">
                            <div class="container py-1">
                                <a href="/apartaments/{{ $apartament->apartament_link }}" style="width: 100%" class="btn btn-primary">{{ __("messages.book") }}</a>
                            </div>
                            <div class="container py-1">
                                <a href="/apartaments/{{ $apartament->apartament_link }}" class="btn btn-primary" style="width: 100%">{{ __("messages.see details") }}</a>
                            </div>
                        </div>
                        <div class="desktop-none" style="width: 100%; height: 100%">
                            <a style=" display: inline-block; width: 100%; height: 100%" href="/apartaments/{{ $apartament->apartament_link }}"></a>
                        </div>
                    </div>
                    <div class="add-to-favourities"><a href="#"><img src='{{ asset("images/results/heart.png") }}'></a></div>
                    <div class="map-description-top">112 PLN</div>
                    <div class="map-description-bottom">{{ __("messages.Breakfast included") }}</div>
                    <div class="description-bottom-right mobile-none">
                        @for ($i = 0; $i < 5; $i++)
                            <img src='{{ asset("images/results/star.png") }}'>
                        @endfor
                        <br><span style="color: green; margin-right: 10px">{{ __("messages.Perfect") }}</span> <span style="color: blue">55 {{ __("messages.reviews_number") }}</span>
                    </div>
                </div>
                <div class="description-below">
                    <span style="font-size: 17px">{{ $apartament->apartament_name }}</span>
                    <br><span style="font-size: 11px">{{ $apartament->apartament_address }}</span>
                    <div>
                        <div class="description-below-img" style="background-image: url('{{ asset("images/results/person.png") }}');"> <span>{{ $apartament->apartament_persons }}</span> </div>
                        <div class="description-below-img" style="background-image: url('{{ asset("images/results/doubleBed.png") }}');"> <span>{{ $apartament->apartament_double_beds }}</span> </div>
                        <div class="description-below-img" style="background-image: url('{{ asset("images/results/bed.png") }}');"> <span>{{ $apartament->apartament_single_beds }}</span> </div>
                        @if ( $apartament->apartament_wifi == 1)
                            <div class="description-below-img" style="background-image: url('{{ asset("images/results/wifi.png") }}');"> </div>
                        @endif
                        @if ( $apartament->apartament_parking == 1)
                            <div class="description-below-img" style="background-image: url('{{ asset("images/results/parking.png") }}');"> </div>
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