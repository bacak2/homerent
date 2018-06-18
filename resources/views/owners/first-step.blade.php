@extends ('layout.layout')
@section('title', 'Dodaj apartament')

@section('content')
<div class="container">
    <h1>Dodaj ofertę</h1>
    <div class="col-12 mt-3 mb-5">
        <div class="form-full-width">
            <p><b>{{ __('O obiekcie') }}</b></p>
            {!! Form::model(Auth::user(), ['/', 'method' => 'GET']) !!}
            <div class="form-group row input-none-apartment-kind">
                {!! Form::label('address', __('Rodzaj domu').':', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-6">
                    <div class="row px-3">
                        <div class="col-6 col-md-3 rItem pr-2" style="padding: 0px;">
                            <input id="type0" type="radio" value="0" name="type"><label for="type0" style="width: 100%"><div id="apartamentKind0" class="font-13 opinion-rItem selected" style="padding: 8px 8px 12px 8px;border-radius: 5px;"><img style="float: left;" src='{{ asset("images/reservations/u4088.png") }}'><div>Apartament</div></div></label>
                        </div>
                        <div class="col-6 col-md-3 rItem pr-2" style="padding: 0px;">
                            <input id="type1" type="radio" value="1" name="type"><label for="type1" style="width: 100%"><div id="apartamentKind1" class="font-13 opinion-rItem" style="padding: 8px 8px 12px 8px;border-radius: 5px;"><img style="float: left;" src='{{ asset("images/reservations/u4088.png") }}'><div>Dom całoroczny</div></div></label>
                        </div>
                        <div class="col-6 col-md-3 rItem pr-2" style="padding: 0px;">
                            <input id="type2" type="radio" value="2" name="type"><label for="type2" style="width: 100%"><div id="apartamentKind2" class="font-13 opinion-rItem" style="padding: 8px 8px 12px 8px;border-radius: 5px;"><img style="float: left;" src='{{ asset("images/reservations/u4088.png") }}'><div>Dom letniskowy</div></div></label>
                        </div>
                        <div class="col-6 col-md-3 rItem" style="padding: 0px;">
                            <input id="type3" type="radio" value="3" name="type"><label for="type3" style="width: 100%"><div id="apartamentKind3" class="font-13 opinion-rItem" style="padding: 8px 8px 12px 8px;border-radius: 5px;"><img style="float: left;" src='{{ asset("images/reservations/u4088.png") }}'><div>Lorem ipsum</div></div></label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 font-11" style="color: #999999">
                    <span id="apartamentKind">Apartament to sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</span>
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('place', __('messages.Place').':', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-6">
                    {!! Form::text('place', '', array('class' => 'full-width', 'required' => 'required', 'oninvalid' => 'setCustomValidity("Wprowadź miejscowość")', ' oninput' => 'setCustomValidity("")')) !!}
                </div>
            </div>

            <p class="mt-5"><b>{{ __('messages.Contact details') }}</b></p>
            @guest
                <p>{{ __('messages.Have you already your account') }}? <span id="log-in-inline" style="font-weight: bold; color: #067eff">{{ __('messages.Log in') }}</span> {{ __('messages.to make everything easier') }}</p>
            @endguest

            <div class="form-group row">
                {!! Form::label('name', __('messages.name').':', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', Auth::user()->name ?? '', array('class' => 'full-width', 'required' => 'required', 'oninvalid' => 'setCustomValidity("Wprowadź imię")', ' oninput' => 'setCustomValidity("")')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('surname', __('messages.surname').':', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-6">
                    {!! Form::text('surname', Auth::user()->surname ?? '', array('class' => 'full-width', 'required' => 'required', 'oninvalid' => 'setCustomValidity("Wprowadź nazwisko")', ' oninput' => 'setCustomValidity("")')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email', 'E-mail:', array('class' => 'col-sm-2 col-form-label')) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', Auth::user()->email ?? '', array('class' => 'full-width')) !!}
                </div>
                <div class="col-sm-4 font-11" style="color: #999999">
                    Ten adres e-mail będzie Ci służyć do logowania lub kontaktu z nami. Adres dla podróżnych do kontaktu z Tobą podasz w kolejnym kroku.
                </div>
            </div>

        </div>
    </div>
</div>

<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <a href="{{ url()->previous() }}" class="btn btn-link ml-2">{{ __('Anuluj') }}</a>
            </div>
            <div class="col-lg-3 col-sm-12">
                <button class="btn ml-2 pointer" type="submit">{{ __('messages.next') }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $("#type0").prop("checked", true);
    });

    var options = {
        url: function(phrase) {
            return "/autocompleteCities?phrase=" + phrase + "&format=json";
        },

        getValue: "city",

        theme: "",
        adjustWidth: false,

        template: {
            type: "description",
            fields: {
                description: "voivodeship"
            }
        }

    };

    $("#place").easyAutocomplete(options);

    $("#log-in-inline").click(function(){
        $('#login-popup').css('display', 'block');
    });

    $(".opinion-rItem").click(function(){
        $(".opinion-rItem").removeClass('selected');
        $(this).addClass('selected');
    });

    $("#apartamentKind0").click(function(){
        $("#apartamentKind").text('Apartament to sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.');
    });

    $("#apartamentKind1").click(function(){
        $("#apartamentKind").text('Dom całoroczny to sit amet, consectetur');
    });

    $("#apartamentKind2").click(function(){
        $("#apartamentKind").text('Dom letniskowy to sit amet, consectetur');
    });

    $("#apartamentKind3").click(function(){
        $("#apartamentKind").text('Lorem ipsum to sit amet, consectetur');
    });

</script>
@endsection