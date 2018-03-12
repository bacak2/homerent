@extends ('includes.reservations')

@section('reservation.content')
<div class="container flex-box">
    <div id="Rtitle"><h4><b>2. {{ __('messages.your data') }}</b></h4></div>
    <div id="Rpath"><span class="active">{{ __('messages.offer') }} - {{ __('messages.your data') }}</span> - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-7 col-sm-12 pr-lg-5 form-full-width">
            {!! Form::open(array('url' => 'foo/bar')) !!}
            <div class="form-group row">
                {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                <div class="col-sm-9">
                    {!! Form::select('title', array('M' => __('messages.Mr'), 'F' => __('messages.Mrs'))) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name', __('messages.Name and surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', '', ['class' => 'required']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('country', __('messages.Country'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::select('country', array('M' => __('Polska'), 'F' => __('Niemcy'))) !!}
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
                    {!! Form::text('postcode', '', array('class' => 'not-full-with')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::text('place') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-3">
                    {!! Form::checkbox('name', 'value') !!}
                </div>
                {!! Form::label('name', __('messages.Place')) !!}
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
                    {!! Form::text('email') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('password', __('messages.Password'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::password('password', ['class' => '']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('password2', __('messages.Repeat password'), array('class' => 'col-sm-3 col-form-label')) !!}
                <div class="col-sm-9">
                    {!! Form::password('password2', ['class' => '']) !!}
                </div>
            </div>
            {!! Form::close() !!}
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
                        <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>sob, 26 kwiecień 2014 (po 15:00)</b></div></div>
                        <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>sob, 26 kwiecień 2014 (po 15:00)</b></div></div>
                        <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">2</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">2</div></div>
                        <div class="res-description txt-blue mt-3">
                            {{ __('messages.change') }}
                        </div>
                </div>
                <div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">200,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">50,00 PLN</span></div></div>
                    <div class="row mb-3"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>50,00 PLN</b></span></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-7 col-sm-12">
            <h4><b>{{ __('messages.Message for the owner') }}</b></h4>
            <div class="row">
                <div class="col-3">Spodziewana godzina przybycia do apartamentu:</div>
                <div class="col-6 col-offset-3">range</div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-7 col-sm-12 pb-3 mb-3" style="border-bottom: dashed">
            <h4><b>{{ __('messages.Method of payment') }}</b></h4>
            <div class="row reservation-payment-method p-3 mb-3">
                <div class="col-lg-3 col-sm-9">
                    Zaliczka
                </div>
                <div class="col-lg-3 col-sm-12">
                    <input id="zalNow" name="zalNow" type="checkbox">
                    <label for="zalNow" class="reservation">opłata online - przelew</label>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <input id="zalNow2" name="zalNow2" type="checkbox">
                    <label for="zalNow2" class="reservation">opłata online - przelew</label>
                </div>
                <div class="col-lg-3 col-sm-3 pt-2" align="right">
                    100,00 PLN
                </div>
            </div>
            <div class="row reservation-payment-method p-3">
                <div class="col-lg-3 col-sm-9">
                    Zaliczka
                </div>
                <div class="col-lg-3 col-sm-12">
                    x
                </div>
                <div class="col-lg-3 col-sm-12">
                    x
                </div>
                <div class="col-lg-3 col-sm-3 pt-2" align="right">
                    100,00 PLN
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12 pb-3 mb-3">
            <div class="row mb-3">
                <input id="accept1" name="accept1" type="checkbox">
                <label for="accept1" class="reservation">Akceptuję regulamin serwisu Nazwa serwisu Lorem ipsum dolor sit amet</label>
            </div>
            <div class="row mb-3">
                <input id="accept2" name="accept2" type="checkbox">
                <label for="accept2" class="reservation">Chcę otrzymywać na mój adres e-mail informacje o promocjach z Homerent</label>
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
                <a id="btn-next" href="#" class="pointer-back next-notAv" style="background-image: url('{{ asset("images/reservations/btn-next-nAv.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('messages.Book and pay online') }}</b>
                    </div>
                </a>
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
                    isValid = true;
                }
            });

            if(isValid == true) {
                $('#btn-next').css({"background-image": "url('http://127.0.0.1:8000/images/reservations/btn-next.png')", "color": "#fff"});
                $('#btn-next').removeClass('next-notAv');
                $('span#notAvDescription').hide();
                $('a#btn-next').attr("href", "{{ url()->previous() }}");

            }
            if(isValid == false){
                $('#btn-next').css({"background-image": "url('http://127.0.0.1:8000/images/reservations/btn-next-nAv.png')", "color": "#acacac"});
                $('#btn-next').addClass('next-notAv');
                $('span#notAvDescription').show();
                $('a#btn-next').attr("href", "#");
            }
        });
</script>
@endsection()