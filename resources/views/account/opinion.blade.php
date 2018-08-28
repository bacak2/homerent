@extends ('layout.layout')

@section('title', __('messages.My account') )

@section('content')

<div class="container">
    <div class="row mt-4 mb-3 pb-3 mx-0" style="border-bottom: black 1px dashed">
        <div class="col-md-7 col-lg-8 pl-0">
            <div class="mb-2"><h3><b>Napisz recenzję</b></h3></div>
            <div class="mb-2">Przekazując informacje na temat pobytu w tym obiekcie pomagasz innym podróżnym podejmować lepsze decyzje.</div>
            <div class="">Prosimy o uzupełnienie przynajmniej pól oznaczonych gwiazdką.</div>
        </div>
        <div class="col-md-5 col-lg-4 pr-0 pl-0 pl-md-3 mt-2 mt-md-0">
            <div class="mb-2 font-12">Recenzja dotyczy:</div>
            <div class="row mb-2 p-1 p-md-3 mx-0" id="opinion-box">
                <div class="col-4 px-0"><img class="img-fluid" src='{{ asset("images/apartaments/$apartament->id/main.jpg") }}'></div>
                <div class="col-8 pl-4 pr-0">
                    {{ $apartament->apartament_name }}
                    <span class="row"><b>{{ $apartament->apartament_city }}</b> ({{ $apartament->apartament_district }})</span>
                    <span class="row">{{ $apartament->apartament_address }}</span>
                    <span class="font-11 row">Przyjazd: <b> {{ strftime("%a, %d %b %Y", strtotime($reservation[0]->reservation_arrive_date))}}</b></span>
                    <span class="font-11 row">Wyjazd: <b> {{ strftime("%a, %d %b %Y", strtotime($reservation[0]->reservation_departure_date))}}</b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 pr-lg-0 form-full-width">
            {!! Form::open(['route' => ['opinions.addOpinion'], 'method' => 'POST']) !!}
            {!! Form::hidden('apartament', $apartament->id) !!}
            {!! Form::hidden('reservation', $reservation[0]->id) !!}
            <div class="form-group row input-none journey-type">
                {!! Form::label('address', __('messages.Typ podrózy').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="row col-sm-9 mx-0 pl-3 pl-md-0">
                    <div class="rItem">
                        <input id="type0" type="radio" value="0" name="type"><label for="type0"><div class="p-2 opinion-rItem"><img src='{{ asset("images/reservations/family.png") }}'>Rodziny</div></label>
                    </div>
                    <div class="rItem">
                        <input id="type1" type="radio" value="1" name="type"><label for="type1"><div class="p-2 opinion-rItem"><img src='{{ asset("images/reservations/couple.png") }}'>Pary</div></label>
                    </div>
                    <div class="rItem">
                        <input id="type2" type="radio" value="2" name="type"><label for="type2"><div class="p-2 opinion-rItem"><img src='{{ asset("images/reservations/Business_Person_24.png") }}'>Biznesowe</div></label>
                    </div>
                    <div class="rItem">
                        <input id="type3" type="radio" value="3" name="type"><label for="type3"><div class="p-2 opinion-rItem"><img src='{{ asset("images/reservations/Group_User_24.png") }}'>Ze znajomymi</div></label>
                    </div>
                    <div class="rItem">
                        <input id="type4" type="radio" value="4" name="type"><label for="type4"><div class="p-2 opinion-rItem"><img src='{{ asset("images/reservations/Male_Person.png") }}'>W pojedynkę</div></label>
                    </div>
                </div>
            </div>
            <div class="form-group row rating-row">
                {!! Form::label('address', __('messages.Ogólna ocena').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="rating-item rating-item-description ml-3 ml-md-0">
                    <span>Zły</span>
                </div>
                <div class="rating-item">
                    <label for="overall">1</label>
                    <input id="overall" type="radio" value="1" name="overall" required oninvalid='setCustomValidity("Wybierz jedną z opcji")' oninput='setCustomValidity("")'>
                </div>
                <div class="rating-item">
                    <label for="overall">2</label>
                    <input id="overall" type="radio" value="2" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">3</label>
                    <input id="overall" type="radio" value="3" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">4</label>
                    <input id="overall" type="radio" value="4" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">5</label>
                    <input id="overall" type="radio" value="5" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">6</label>
                    <input id="overall" type="radio" value="6" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">7</label>
                    <input id="overall" type="radio" value="7" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">8</label>
                    <input id="overall" type="radio" value="8" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">9</label>
                    <input id="overall" type="radio" value="9" name="overall">
                </div>
                <div class="rating-item">
                    <label for="overall">10</label>
                    <input id="overall" type="radio" value="10" name="overall">
                </div>
                <div class="rating-item rating-item-description">
                    <span>Doskonały</span>
                </div>

                <br style="clear:both;" />
            </div>
            <div class="form-group row">
                {!! Form::label('pros', __('messages.Plusy obiektu').":", array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('pros', '', ['placeholder' => 'Napisz, co Ci się podobało w tym obiekcie lub w obsłudze.', 'rows' => '4', 'cols' => '60', 'onkeypress' => 'licz1st(this,499)', 'style' => 'width:100%', 'class' => 'font-m-13']) !!}
                    <p class="font-11">Zostało <span id="firstTextarea">500</span> znaków</p>
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('cons', __('messages.Co można poprawić').":", array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('cons', '', ['placeholder' => 'Napisz, co Cię rozczarowało lub powinno zostać poprawione.', 'rows' => '4', 'cols' => '60', 'onkeypress' => 'licz2nd(this,499)', 'style' => 'width:100%', 'class' => 'font-m-13']) !!}
                    <p class="font-11">Zostało <span id="secondTextarea">500</span> znaków</p>
                </div>
            </div>
            <h4><b>{{__('messages.Ocena szczegółowa')}}</b></h4>
            <div class="form-group row rating-row">
                {!! Form::label('address', __('messages.Czystość').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="rating-item rating-item-description ml-3 ml-md-0">
                    <span>Zły</span>
                </div>
                <div class="rating-item">
                    <label for="cleanliness">1</label>
                    <input id="cleanliness" type="radio" value="1" name="cleanliness" required>
                </div>
                <div class="rating-item">
                    <label for="cleanliness">2</label>
                    <input id="cleanliness" type="radio" value="2" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">3</label>
                    <input id="cleanliness" type="radio" value="3" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">4</label>
                    <input id="cleanliness" type="radio" value="4" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">5</label>
                    <input id="cleanliness" type="radio" value="5" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">6</label>
                    <input id="cleanliness" type="radio" value="6" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">7</label>
                    <input id="cleanliness" type="radio" value="7" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">8</label>
                    <input id="cleanliness" type="radio" value="8" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">9</label>
                    <input id="cleanliness" type="radio" value="9" name="cleanliness">
                </div>
                <div class="rating-item">
                    <label for="cleanliness">10</label>
                    <input id="cleanliness" type="radio" value="10" name="cleanliness">
                </div>
                <div class="rating-item rating-item-description">
                    <span>Doskonały</span>
                </div>
                <br style="clear:both;" />
            </div>
            <div class="form-group row rating-row">
                {!! Form::label('address', __('messages.Lokalizacja').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="rating-item rating-item-description ml-3 ml-md-0">
                    <span>Zły</span>
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="1" name="location" required>
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="2" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="3" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="4" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="5" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="6" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="7" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="8" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="9" name="location">
                </div>
                <div class="rating-item">
                    <label for="location"></label>
                    <input id="location" type="radio" value="10" name="location">
                </div>
                <div class="rating-item rating-item-description">
                    <span>Doskonały</span>
                </div>

                <br style="clear:both;" />
            </div>
            <div class="form-group row rating-row">
                {!! Form::label('address', __('messages.Udogodnienia').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="rating-item rating-item-description ml-3 ml-md-0">
                    <span>Zły</span>
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="1" name="facilities" required>
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="2" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="3" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="4" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="5" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="6" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="7" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="8" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="9" name="facilities">
                </div>
                <div class="rating-item">
                    <label for="facilities"></label>
                    <input id="facilities" type="radio" value="10" name="facilities">
                </div>
                <div class="rating-item rating-item-description">
                    <span>Doskonały</span>
                </div>

                <br style="clear:both;" />
            </div>
            <div class="form-group row rating-row">
                {!! Form::label('address', __('messages.Obsługa').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="rating-item rating-item-description ml-3 ml-md-0">
                    <span>Zły</span>
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="1" name="staff" required>
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="2" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="3" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="4" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="5" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="6" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="7" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="8" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="9" name="staff">
                </div>
                <div class="rating-item">
                    <label for="staff"></label>
                    <input id="staff" type="radio" value="10" name="staff">
                </div>
                <div class="rating-item rating-item-description">
                    <span>Doskonały</span>
                </div>

                <br style="clear:both;" />
            </div>
            <div class="form-group row rating-row">
                {!! Form::label('address', __('messages.Stosunek jakości do ceny').':*', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="rating-item rating-item-description ml-3 ml-md-0">
                    <span>Zły</span>
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="1" name="quality_per_price" required>
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="2" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="3" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="4" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="5" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="6" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="7" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="8" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="9" name="quality_per_price">
                </div>
                <div class="rating-item">
                    <label for="quality_per_price"></label>
                    <input id="quality_per_price" type="radio" value="10" name="quality_per_price">
                </div>
                <div class="rating-item rating-item-description">
                    <span>Doskonały</span>
                </div>

                <br style="clear:both;" />
            </div>
        </div>

    </div>
    <div class="col-lg-7 col-sm-12 pb-3 mt-4" style="border-bottom: black 3px dashed">
        <div class="row mb-4 pb-3 pb-md-0 pb-lg-3">
            <input id="accept1" name="accept1" type="checkbox" required>
            <label for="accept1" class="inline-label">{{ __('* Disclamer o tym, że to mają być recenzje oparte na doświadczeniach - treść do ułożenia.') }} Otozakopane</label>
        </div>
        <div class="row mb-4">
            <input id="accept2" name="accept2" type="checkbox">
            <label for="accept2" class="inline-label">{{ __('messages.Opublikuj na mojej tablicy w Facebook') }} Otozakopane</label>
        </div>
        <div class="row mb-4">
            <input id="anonymously" name="anonymously" type="checkbox">
            <label for="anonymously" class="inline-label">{{ __('messages.Chcę wystawić recenzję w serwisie nazwa_serwisu.pl anonimowo.') }} Otozakopane</label>
            <span class="mt-4 mt-md-2" style="margin-left: 16px; font-size: 10px; color: darkgrey;">
                Nie publikujemy nigdzie nazwisk osób wystawiających recenzje. Podajemy jedynie imiona oraz kraj/miasto pochodzenia. Takie informacje są bardziej wiarygodne dla innych podróżnych. Jeśli jednak nie chcesz ich publikować, oznacz tę opcję.
            </span>
        </div>
    </div>
    <div class="row mt-3 mb-5 mx-0">
        <input class="btn btn-primary font-16" type="submit" value="Wyślij recenzcję">
        <a href="{{ url()->previous() }}" class="btn font-13">Anuluj</a>
    </div>
    {!! Form::close() !!}
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#type0").prop("checked", true);
    });

    function licz1st(pole,max){
        document.getElementById("firstTextarea").innerHTML=500-pole.value.length;
        if (pole.value.length > max){
            pole.value = pole.value.substr(0,max);
        }
    }
    function licz2nd(pole,max){
        document.getElementById("secondTextarea").innerHTML=500-pole.value.length;
        if (pole.value.length > max){
            pole.value = pole.value.substr(0,max);
        }
    }
</script>
@endsection