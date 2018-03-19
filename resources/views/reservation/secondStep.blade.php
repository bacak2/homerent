@extends ('includes.reservations')

@section('reservation.content')
    <div class="container">
        <h2><b>{{ __('messages.reservation') }}</b></h2>
    </div>
<div class="container flex-box">
    <div id="Rtitle"><h4><b>2. {{ __('messages.your data') }}</b></h4></div>
    <div id="Rpath"><span class="active">{{ __('messages.offer') }} - {{ __('messages.your data') }}</span> - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-7 col-sm-12 pr-lg-5 form-full-width">
            {!! Form::model($request, ['route' => ['reservations.thirdStep'], 'method' => 'POST']) !!}
            {!! Form::hidden('link', $apartament->descriptions[0]->apartament_link) !!}
            {!! Form::hidden('przyjazd', $request->przyjazd) !!}
            {!! Form::hidden('powrot', $request->powrot) !!}
            {!! Form::hidden('ilenocy', $request->ilenocy) !!}
            {!! Form::hidden('dorosli', $request->dorosli) !!}
            {!! Form::hidden('dzieci', $request->dzieci) !!}
            {!! Form::hidden('wiadomoscDodatkowa', $request->wiadomoscDodatkowa) !!}
            <div class="form-group row">
                {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                <div class="col-sm-9">
                    {!! Form::select('title', array('M' => __('messages.Mr'), 'F' => __('messages.Mrs'))) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name and surname', __('messages.Name and surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('name and surname', $request->name.' '.$request->surname, ['class' => 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('country', __('messages.Country'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::select('country', array('Polska' => __('Polska'), 'Niemcy' => __('Niemcy')), 'Polska', array('class' => 'col-sm-12 col-lg-3')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('address', '', ['class' => 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('postcode', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('postcode', '', array('class' => 'not-full-with col-sm-12 col-lg-6')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('place', '', ['class' => 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                    <div class="offset-sm-3">
                        {!! Form::checkbox('wantInvoice') !!}
                    </div>
                    {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 12px']) !!}
            </div>
            <div class="form-group row">
                {!! Form::label('phone', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('email', $request->email, ['class' => 'required']) !!}
                </div>
            </div>
            @guest
            <div class="form-group row">
                <div class="offset-sm-3">
                    {!! Form::checkbox('dontWantAccount') !!}
                </div>
                {!! Form::label('dontWantAccount', __('messages.dontWantAccount'), ['style'=>'font-size: 10px']) !!}
            </div>
            <div class="form-group row">
                {!! Form::label('password', __('messages.Password'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-6">
                    {!! Form::password('password', ['class' => 'required']) !!}
                </div>
                <div class="col-sm-3">
                    {{ __('messages.Password strength') }}: <div class="figure" id="strength_score">0%</div>
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('password2', __('messages.Repeat password'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-6">
                    {!! Form::password('password2', ['class' => 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-3" id="passNotSame" style="display: none; color: red;"><i class="fa fa-2x fa-exclamation-triangle"></i>Wpisane hasła nie są takie same.</div>
            </div>
            @endguest
        </div>
        <div class="col-lg-4 mobile-none mt-3">
            <div class="reservation-item p-3">
                <div class="row ">
                    <div class="col-4">
                        <div class="apartament " style="background-image: url('{{ asset("images/apartaments/$apartament->id/1.jpg") }}'); background-size: cover; margin-bottom: 0px; width: 100px; height: 60px;">
                        </div>
                    </div>
                    <div class="col-8">
                                <div class="txt-blue"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                                <div class="mb-2">{{ $apartament->apartament_address }}</div>
                                <hr class="desktop-none">
                    </div>
                </div>
                <div class="mb-3 pb-3" style="border-bottom: dashed;">
                        <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>{{ $request->przyjazd }}</b></div></div>
                        <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>{{ $request->powrot }}</b></div></div>
                        <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">{{ $request->ilenocy }}</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">{{ ($request->dorosli + $request->dzieci) }}</div></div>
                        <div class="res-description txt-blue mt-3">
                            {{ __('messages.change') }}
                        </div>
                </div>
                <div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">{{ number_format(200*$request->ilenocy, 2, ',', ' ') }} PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">{{ number_format(50, 2, ',', ' ') }} PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">{{ number_format(50, 2, ',', ' ') }}  PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">{{ number_format(50, 2, ',', ' ') }}  PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>{{ number_format(50, 2, ',', ' ') }}  PLN</b></span></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-7 col-sm-12">
            <h4><b>{{ __('messages.Message for the owner') }}</b></h4>
            <div class="row">
                <div class="col-lg-12 col-sm-3">
                    {{ __('messages.Expected time') }}:
                    <input id="godzinaPrzyjazdu" name="godzinaPrzyjazdu" class="slider-time" style="width: 60px; margin-bottom: 20px">
                </div>
                <div class="col-lg-8 col-sm-6 col-lg-offset-3">
                    <div id="time-range">
                        <div class="sliders_step1">
                            <div id="slider-range"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-7 col-sm-12 pb-3 mb-3" style="border-bottom: dashed">
            <h4><b>{{ __('messages.Method of payment') }}</b></h4>
            <div class="row reservation-payment-method pt-2 pb-4 mb-3">
                <div class="col-lg-3 col-sm-9">
                    <b>{{ __('messages.Advance') }}</b>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <input id="zalNow" name="zal" value="1" type="radio">
                    <label for="zalNow" class="reservation">{{ __('messages.payment booking immediately') }}</label>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <input id="zalNow2" name="zal" value="2" type="radio">
                    <label for="zalNow2" class="reservation">{{ __('messages.payment booking initial') }}</label>
                </div>
                <div class="col-lg-3 col-sm-3 pt-2" align="right">
                    <b>100,00 PLN</b>
                </div>
            </div>
            <div class="row reservation-payment-method pt-2 pb-4">
                <div class="col-lg-3 col-sm-9">
                    <b>{{ __('messages.Total cost') }}</b>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <input id="allNow" name="allNow" value="1" type="radio">
                    <label for="allNow" class="reservation">{{ __('messages.payment booking immediately') }}</label>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <input id="allNow2" name="allNow" value="2" type="radio">
                    <label for="allNow2" class="reservation">{{ __('messages.payment booking initial') }}</label>
                </div>
                <div class="col-lg-3 col-sm-3 pt-2" align="right">
                    <b>380,00 PLN</b>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12 pb-3 mb-3">
            <div class="row mb-4">
                <input id="accept1" name="accept1" type="checkbox">
                <label for="accept1" class="inline-label">{{ __('messages.I accept the terms of use') }} Homent</label>
            </div>
            <div class="row mb-4">
                <input id="accept2" name="accept2" type="checkbox">
                <label for="accept2" class="inline-label">{{ __('messages.I would like to receive information about promotions from') }} Homent</label>
            </div>
        </div>
    </div>

</div>



<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-3 col-sm-12 mb-2">
                <a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/reservations/btn-back.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('messages.Return') }}</b>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 offset-lg-5 col-sm-12">
                <a id="nextNotAv" href="#" class="pointer-back next-notAv" style="background-image: url('{{ asset("images/reservations/btn-next-nAv.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('messages.Book and pay online') }}</b>
                    </div>
                </a>
                <button id="nextAv" class="btn ml-2 pointer" type="submit" style="display: none;">{{ __('messages.next') }}</button>
                {!! Form::close() !!}
                <span id="notAvDescription" style="font-size: 11px">{{ __('messages.First, choose the method of payment') }}</span>
            </div>
        </div>
    </div>
</div>

<script>
        $('input').change(function(e) {
            var isValid = true;
            $('input.required').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false;
                }
                else {
                    if (checkSame()) isValid = true;
                    else {
                        isValid = false;
                        return false;
                    }
                }
            });

            if(isValid == true) {
                $('#nextNotAv').css({"display": "none"});
                $('#nextAv').css({"display": "inline-block"});
                $('span#notAvDescription').hide();

            }
            if(isValid == false){
                $('#nextNotAv').css({"display": "inline-block"});
                $('#nextAv').css({"display": "none"});
                $('span#notAvDescription').show();
            }
        });

        $("#slider-range").slider({
            range: false,
            min: 0,
            max: 1440,
            step: 15,
            values: [720],
            slide: function (e, ui) {
                var hours1 = Math.floor(ui.values[0] / 60);
                var minutes1 = ui.values[0] - (hours1 * 60);
                if (hours1.length == 1) hours1 = '0' + hours1;
                if (minutes1.length == 1) minutes1 = '0' + minutes1;
                if (minutes1 == 0) minutes1 = '00';

                $('.slider-time').val(hours1 + ':' + minutes1);
            }
        });

        function scorePassword(pass) {
            var wynik = 0;
            var warianty = {
                cyfry: /\d/.test(pass),
                male: /[a-z]/.test(pass),
                duze: /[A-Z]/.test(pass),
                specjalne: /\W/.test(pass),
                dlugosc: pass.length > 7
            };
            for(var war in warianty)
                if(warianty[war] == true) wynik += 100 / 5;

            var color = '';

            if(wynik < 50) color ='red';
            else if(wynik > 50 && wynik < 100) color ='yellow';
            else if(wynik == 100) color = 'green';
            $("#strength_score").text(wynik + '%');
            $("#strength_score").css('background-color', color);
            return parseInt(wynik);
        }

        function checkSame(){
            var pass = $("#password").val();
            var pass2 = $("#password2").val();
            if(pass !== pass2){
                $("#passNotSame").show();
                return false;
            }
            else {
                $("#passNotSame").hide();
                return true;
            }

        }

        $(function() {
            $("#password, #password2").on("keyup", function() {
                scorePassword($(this).val());
                checkSame();
            });
        });

</script>
@endsection()