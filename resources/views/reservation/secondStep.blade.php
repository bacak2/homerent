@extends ('includes.reservations')

@section('reservation.content')
    <div class="container">
        <h1 class="h1-reservation">{{ __('messages.reservation') }}</h1>
    </div>
    <div class="container flex-box mb-2">
        <div id="Rtitle"><h2 class="h2-reservation mt-3">2. {{ __('messages.your data') }}</h2></div>
        <div class="mobile-none font-12" id="Rpath">
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                <span class="active number">1</span>
                <span class="activeBold ml-2">{{ __('messages.offer') }}</span>
            </div>
            <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/thisStepBlack.png") }}'>
                <span class="active number">2</span>
                <span class="activeBold ml-2">{{ __('messages.your data') }}</span>
            </div>
            <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/fullLight.png") }}'>
                <span class="number">3</span>
                <span class="not-active ml-2">{{ __('messages.payment') }}</span>
            </div>
            <img class="mx-2" src='{{ asset("images/reservations/lineNotActive.png") }}'>
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/fullLight.png") }}'>
                <span class="number">4</span>
                <span class="not-active ml-2">{{ __('messages.confirmation') }}</span>
            </div>
        </div>
        <div class="desktop-none font-11 row no-gutters" id="Rpath"><div class="bold col">{{ __('messages.offer') }}</div><div class="pr-2"><img src='{{ asset("images/reservations/lineActiveMobile.png") }}'></div><div class="col bold">{{ __('messages.your data') }}</div><div class="pr-3"><img src='{{ asset("images/reservations/lineNotActiveMobile.png") }}'></div><div class="col">{{ __('messages.payment') }}</div><div class="pr-2"><img src='{{ asset("images/reservations/lineNotActiveMobile.png") }}'></div><div class="col">{{ __('messages.confirmation') }}</div></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-12 pr-lg-5 form-full-width">
                {!! Form::model($request, ['route' => ['reservations.thirdStep'], 'method' => 'POST', 'id' => 'main-form']) !!}
                {!! Form::hidden('link', $apartament->descriptions[0]->apartament_link) !!}
                {!! Form::hidden('przyjazd', $request->przyjazd) !!}
                {!! Form::hidden('powrot', $request->powrot) !!}
                {!! Form::hidden('przyjazdDb', $request->przyjazdDb) !!}
                {!! Form::hidden('powrotDb', $request->powrotDb) !!}
                {!! Form::hidden('ilenocy', $request->ilenocy) !!}
                {!! Form::hidden('dorosli', $request->dorosli) !!}
                {!! Form::hidden('dzieci', $request->dzieci) !!}
                {!! Form::hidden('wiadomoscDodatkowa', $request->wiadomoscDodatkowa) !!}
                {!! Form::hidden('id', $request->id) !!}
                {!! Form::hidden('payment_all_nights', $request->nightsPrice) !!}
                {!! Form::hidden('payment_final_cleaning', $request->cleaning) !!}
                {!! Form::hidden('payment_additional_services', $request->servicesPrice) !!}
                {!! Form::hidden('payment_basic_service', $request->basicService) !!}
                {!! Form::hidden('fullPrice', Crypt::encrypt($request->fullPrice)) !!}
                @auth
                    @if($request->change === NULL && !($accountData->first()->name == NULL || $accountData->first()->surname == NULL || $accountData->first()->address == NULL || $accountData->first()->postcode == NULL || $accountData->first()->place == NULL || $accountData->first()->phone == NULL))
                        <ul class="nav nav-tabs">
                            @foreach($accountData as $data)
                                <li class="nav-item">
                                    <a class="nav-link @if ($loop->first) active @endif" href="#{{ $data->id }}" role="tab" data-toggle="tab">{{ $data->label }}</a>
                                </li>
                        @endforeach
                        <!--li class="nav-item">
                        <a class="nav-link" href="#addNew" role="tab" data-toggle="tab">+</a>
                    </li-->
                        </ul>
                        <div class="tab-content pt-4">
                            @foreach($accountData as $key => $data)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{ $data->id }}">
                                    <div class="mb-2">{{ $data->title }} <span class="pull-right"><a href="{{request()->fullUrlWithQuery(["change"=>"$key"])}}">Zmień</a>|<a href="#" onclick="confirmDelete({{$data->id}})">Usuń dane</a></span></div>
                                    <div>{{ $data->name }} {{ $data->surname }}</div>
                                    <div>{{ $data->address }}</div>
                                    <div>{{ $data->postcode }} {{ $data->place }}</div>
                                    <div class="mb-2">{{ $data->country }}</div>
                                    @if($data->invoice==1)
                                        <div>Faktura na:</div>
                                        <div>{{ $data->name_invoice }} {{ $data->surname_invoice }}</div>
                                        <div>{{ $data->address_invoice }}</div>
                                        <div>{{ $data->postcode_invoice }} {{ $data->place_invoice }}</div>
                                    @endif
                                    <div class="mt-2">{{ $data->phone }}</div>
                                    <div>{{ $data->email }}</div>
                                </div>
                        @endforeach
                        <!--div class="tab-pane" id="addNew">
                            <div class="form-group row">
                                {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                                <div class="col-sm-9">
                                    {!! Form::select('title', array(__('messages.Mr') => __('messages.Mr'), __('messages.Mrs') => __('messages.Mrs'))) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name and surname', __('messages.Name and surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name and surname', $request->name.' '.$request->surname, ['class' => 'required full-width']) !!}
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
                                    {!! Form::text('address', '', ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('postcode', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('postcode', '', array('class' => 'required not-full-width col-sm-12 col-lg-6')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('place', '', ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('phone', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('phone', '', ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('email', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::email('email', $request->email, ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3">
                                    {!! Form::checkbox('wantInvoice') !!}
                                </div>
                                {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 10px']) !!}
                                </div>
                                <span id="invoiceFields" style="display: none">
                                    <h3><b>Dane do faktury</b></h3>
                                    <div class="form-group row">
{!! Form::label('address_invoice', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('address_invoice', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('postcode_invoice', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('postcode_invoice', '', array('class' => 'not-full-width col-sm-12 col-lg-6')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('place_invoice', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('place_invoice', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('company_name', __('messages.Company name'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('company_name', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('nip', __('NIP'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('nip', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                        </span>
                    </div-->
                        </div>
                    @else
                        <ul class="nav nav-tabs">
                            @foreach($accountData as $data)
                                @if ($loop->index == $request->change)
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#{{ $data->id }}" role="tab" data-toggle="tab">
                                            Nazwa:
                                            {!! Form::text('label', $accountData["$request->change"]->label ?? $accountData->first()->label, ['class' => '', 'style'=>'height: 24px; width: 200px; font-size:12px']) !!}
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="#{{ $data->id }}" role="tab" data-toggle="tab">{{ $data->label }}</a>
                                    </li>
                            @endif
                        @endforeach
                        <!--li class="nav-item">
                            <a class="nav-link" href="#addNew" role="tab" data-toggle="tab">+</a>
                        </li-->
                        </ul>
                        <div class="tab-content pt-4">
                            @foreach($accountData as $key => $data)
                                @if ($loop->index == $request->change || $loop->index == -1)
                                    <div class="tab-pane active" id="{{ $data->id }}">
                                        <div id="auth-form">
                                        <!--div class="form-group row">
                                            {{-- Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                                            <div class="col-sm-9">
                                                {!! Form::select('title', '', array(__('messages.Mr') => __('messages.Mr'), __('messages.Mrs') => __('messages.Mrs'))) !!--}}
                                                </div>
                                            </div-->
                                            <div class="form-group row">
                                                {!! Form::label('name', __('messages.Name'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('name', $data->name, ['class' => 'required full-width']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('surname', __('messages.Surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('surname', $data->surname, ['class' => 'required full-width']) !!}
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
                                                    {!! Form::text('address', $data->address, ['class' => 'required full-width']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('postcode', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('postcode', $data->postcode, array('class' => 'required not-full-width col-sm-12 col-lg-6', 'pattern' => '[0-9]{2}-[0-9]{3}', 'oninvalid' => 'setCustomValidity("Wprowadź poprawny kod pocztowy")', ' oninput' => 'setCustomValidity("")')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('place', $data->place, ['class' => 'required full-width']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row mx-0">
                                                <div class="offset-md-3">
                                                    <input id="wantInvoice" name="wantInvoice" type="checkbox">
                                                </div>
                                                {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 10px']) !!}
                                            </div>
                                            <span id="invoiceFields" style="display: none">
                                            <h2 class="h2-reservation">Dane do faktury</h2>
                                            <div class="form-group row">
                                                {!! Form::label('address_invoice', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('address_invoice', '', ['class' => 'full-width']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('postcode_invoice', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('postcode_invoice', '', array('class' => 'not-full-width col-sm-12 col-lg-6')) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('place_invoice', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('place_invoice', '', ['class' => 'full-width']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('company_name', __('messages.Company name'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('company_name', '', ['class' => 'full-width']) !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('nip', __('NIP'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::text('nip', '', ['class' => 'full-width']) !!}
                                                </div>
                                            </div>
                                        </span>
                                            <div class="form-group row">
                                                {!! Form::label('phone', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-2">{!! Form::select('prefix', array('+48'=> '+48', '+44' => '+44'), '', ['style' => 'height: 100%']) !!}</div>
                                                        <div class="col-10">{!! Form::text('phone', $data->phone, ['class' => 'full-width required ']) !!}</div>
                                                    </div>
                                                    <div class="font-11" style="color: gray">
                                                        Ten numer telefonu jest potrzebny właścicielowi do kontaktu z Tobą.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {!! Form::label('email', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
                                                <div class="col-sm-9">
                                                    {!! Form::email('email', $request->email, ['class' => 'required full-width', 'oninvalid' => 'setCustomValidity("Wprowadź poprawny adres email")', ' oninput' => 'setCustomValidity("")']) !!}
                                                    <div class="font-11" style="color: gray">
                                                        Ten adres e-mail będzie służył do kontaktu z Tobą oraz do logowania (jeśli się zdecydujesz założyć konto).
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="tab-pane" id="{{ $data->id }}">
                                        <div class="mb-2">{{ $data->title }} <span class="pull-right"><a href="{{request()->fullUrlWithQuery(["change"=>"$key"])}}">Zmień</a>|<a href="#">Usuń dane</a></span></div>
                                        <div>{{ $data->name }} {{ $data->surname }}</div>
                                        <div>{{ $data->address }}</div>
                                        <div>{{ $data->postcode }} {{ $data->place }}</div>
                                        <div class="mb-2">{{ $data->country }}</div>
                                        <div>Faktura na:</div>
                                        <div>{{ $data->name }} {{ $data->surname }}</div>
                                        <div>{{ $data->address }}</div>
                                        <div>{{ $data->postcode }} {{ $data->place }}</div>
                                        <div class="mt-2">{{ $data->phone }}</div>
                                        <div>{{ $data->email }}</div>
                                    </div>
                            @endif
                        @endforeach
                        <!--div class="tab-pane" id="addNew">
                            <div class="form-group row">
                                {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                                <div class="col-sm-9">
                                    {!! Form::select('title', array(__('messages.Mr') => __('messages.Mr'), __('messages.Mrs') => __('messages.Mrs'))) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name and surname', __('messages.Name and surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name and surname', $request->name.' '.$request->surname, ['class' => 'required full-width']) !!}
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
                                    {!! Form::text('address', '', ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('postcode', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('postcode', '', array('class' => 'required not-full-width col-sm-12 col-lg-6')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('place', '', ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('phone', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('phone', '', ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('email', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::email('email', $request->email, ['class' => 'required full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3">
                                    {!! Form::checkbox('wantInvoice') !!}
                                </div>
                                {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 10px']) !!}
                                </div>
                                <span id="invoiceFields" style="display: none">
                                    <h3><b>Dane do faktury</b></h3>
                                    <div class="form-group row">
{!! Form::label('address_invoice', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('address_invoice', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('postcode_invoice', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('postcode_invoice', '', array('class' => 'not-full-width col-sm-12 col-lg-6')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('place_invoice', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('place_invoice', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('company_name', __('messages.Company name'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('company_name', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
{!! Form::label('nip', __('NIP'), array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
{!! Form::text('nip', '', ['class' => 'full-width']) !!}
                                </div>
                            </div>
                        </span>
                    </div-->
                        </div>
                    @endif
                @endauth

                @guest
                    <p>{{ __('messages.Have you already your account') }}? <span id="log-in-inline" style="font-weight: bold; color: #067eff">{{ __('messages.Log in') }}</span> {{ __('messages.to make everything easier') }}</p>
                    <div class="form-group row">
                        {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
                        <div class="col-sm-9">
                            {!! Form::select('title', array(__('messages.Mr') => __('messages.Mr'), __('messages.Mrs') => __('messages.Mrs'))) !!}
                        </div>
                    </div>
                    <div class="form-group row" id="nameAndSurnameText">
                        <div class="col-sm-3 col-form-label">
                            {{__('messages.Name and surname')}}
                        </div>
                        <div class="col-sm-9 col-form-label">
                            {{$request->name.' '.$request->surname}} <span id="nameChange" class="font-12 ml-3" style="color: #007bff">Zmień</span>
                        </div>
                    </div>
                    <span id="nameAndSurname" style="display: none">
                <div class="form-group row">
                    {!! Form::label('name', __('messages.Name'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', $request->name, ['class' => 'required full-width']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('surname', __('messages.Surname'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('surname', $request->surname, ['class' => 'required full-width']) !!}
                    </div>
                </div>
            </span>
                    <div class="form-group row">
                        {!! Form::label('country', __('messages.Country'), array('class' => 'col-sm-3 col-form-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::select('country', array('Polska' => __('Polska'), 'Niemcy' => __('Niemcy')), 'Polska', array('class' => 'col-sm-12 col-lg-3')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('address', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('address', '', ['class' => 'required full-width']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('postcode', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('postcode', '', array('class' => 'required not-full-width col-sm-12 col-lg-6', 'pattern' => '[0-9]{2}-[0-9]{3}', 'oninvalid' => 'setCustomValidity("Wprowadź poprawny kod pocztowy")', ' oninput' => 'setCustomValidity("")')) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('place', '', ['class' => 'required full-width']) !!}
                        </div>
                    </div>
                    <div class="form-group row mx-0">
                        <div class="offset-md-3">
                            {!! Form::checkbox('wantInvoice') !!}
                        </div>
                        {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 10px']) !!}
                    </div>
                    <span id="invoiceFields" style="display: none">
                <h2 class="h2-reservation">Dane do faktury</h2>
                <div class="form-group row">
                    {!! Form::label('address_invoice', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('address_invoice', '', ['class' => 'full-width']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('postcode_invoice', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('postcode_invoice', '', array('class' => 'not-full-width col-sm-12 col-lg-6')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('place_invoice', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('place_invoice', '', ['class' => 'full-width']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('company_name', __('messages.Company name'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('company_name', '', ['class' => 'full-width']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('nip', __('NIP'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('nip', '', ['class' => 'full-width']) !!}
                    </div>
                </div>
            </span>
                    <div class="form-group row">
                        {!! Form::label('phone', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-2">{!! Form::select('prefix', array('+48'=> '+48', '+44' => '+44'), '', ['style' => 'height: 100%']) !!}</div>
                                <div class="col-10">{!! Form::text('phone', '', ['class' => 'full-width required ']) !!}</div>
                            </div>
                            <div class="font-11" style="color: gray">
                                Ten numer telefonu jest potrzebny właścicielowi do kontaktu z Tobą.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('email', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
                        <div class="col-sm-9">
                            {!! Form::email('email', $request->email, ['class' => 'required full-width', 'oninvalid' => 'setCustomValidity("Wprowadź poprawny adres email")', ' oninput' => 'setCustomValidity("")']) !!}
                            <div class="font-11" style="color: gray">
                                Ten adres e-mail będzie służył do kontaktu z Tobą oraz do logowania (jeśli się zdecydujesz założyć konto).
                            </div>
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="row">
                            <div class="offset-md-3" style="color: red;"><i class="fa fa-lg fa-exclamation-triangle"></i><span class="font-11 ml-2">{{$errors->first()}}</span></div>
                        </div>
                    @endif
                    <div class="form-group row mx-0">
                        <div {{--class="offset-md-3"--}}>
                            <input id="dontWantAccount" name="dontWantAccount" type="checkbox">
                        </div>
                        {!! Form::label('dontWantAccount', __('messages.dontWantAccount'), ['style'=>'font-size: 10px']) !!}
                    </div>
                    <span id="passwordFields">
                <div class="form-group row">
                    {!! Form::label('password', __('messages.Password'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::password('password', ['class' => 'required full-width']) !!}
                    </div>
                    <div class="col-sm-3">
                        {{ __('messages.Password strength') }}: <div class="figure" id="strength_score">0%</div>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password2', __('messages.Repeat password'), array('class' => 'col-sm-3 col-form-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::password('password2', ['class' => 'required full-width']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-3" id="passNotSame" style="display: none; color: red;"><i class="fa fa-lg fa-exclamation-triangle"></i><span class="font-11 ml-2">Wpisane hasła nie są takie same.</span></div>
                </div>
                <div class="row">
                    <div class="offset-md-3" id="passAtLeast" style="display: none; color: red;"><i class="fa fa-lg fa-exclamation-triangle"></i><span class="font-11 ml-2">Hasło musi mieć co najmniej 6 znaków.</span></div>
                </div>
            </span>
                @endguest
                <div class="row mt-5">
                    <div class="col-lg-12 col-sm-12">
                        <h2 class="h2-reservation">{{ __('messages.Message for the owner') }}</h2>
                        <div class="row">
                            <div class="col-xs-3 col-sm-12">
                                <span class="font-m-14">{{ __('messages.Expected time') }}:</span>
                                <input id="godzinaPrzyjazdu" value="15:00" name="godzinaPrzyjazdu" class="slider-time" style="width: 60px; margin-bottom: 20px">
                                <div id=""></div>
                            </div>
                            <div class="col-lg-8 col-sm-10 col-lg-offset-3">
                                <div id="time-range">
                                    <div class="sliders_step1">
                                        <div id="slider-range"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 not-full-width mx-0" id="paymentMethod">
                    <h2 class="h2-reservation">{{ __('messages.Method of payment') }}</h2>
                    <div class="col-lg-12 col-sm-12 pb-3 mb-3" style="border-bottom: dashed">
                        <div class="row reservation-payment-method pt-2 pb-4 mb-3">
                            <div class="col-lg-3 col-sm-9">
                                <b>{{ __('messages.Advance') }}</b>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <input id="zalNow" name="payment_method" value="3" type="radio">
                                <label for="zalNow" class="reservation">{{ __('messages.payment booking immediately') }}</label>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <input id="zalNow2" name="payment_method" value="4" type="radio">
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
                                <input id="payment_method" name="payment_method" value="1" type="radio">
                                <label for="payment_method" class="reservation">{{ __('messages.payment booking immediately') }}</label>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <input id="payment_method2" name="payment_method" value="2" type="radio">
                                <label for="payment_method2" class="reservation">{{ __('messages.payment booking initial') }}</label>
                            </div>
                            <div class="col-lg-3 col-sm-3 pt-2" align="right">
                                <b><span>{{ number_format($request->fullPrice, 2, ',', ' ') }}</span> PLN</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 pb-3 mb-3">
                        <div class="row mb-5">
                            <input id="accept0" name="accept0" type="checkbox" class="required">
                            <label for="accept0" class="inline-label">Akceptuję ustawę o ochronie danych osobowych (Lorem ipsum, dokładny tekst tego disclamera do ułożenia przez prawnika, być może nie będzie potrzebny, jeśli jest akceptacja regulaminu)</label>
                        </div>
                        <div class="row mb-4 pt-4 pt-md-0">
                            <input id="accept1" name="accept1" type="checkbox" class="required">
                            <label for="accept1" class="inline-label">{{ __('messages.I accept the terms of use') }} Otozakopane</label>
                        </div>
                        <div class="row mb-4">
                            <input id="accept2" name="accept2" type="checkbox">
                            <label for="accept2" class="inline-label">{{ __('messages.I would like to receive information about promotions from') }} Otozakopane</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="stickyheader" class="d-none d-lg-block mt-3">
                <div class="reservation-item p-3">
                    <div class="row ">
                        <div class="col-4">
                            <div class="apartament " style="background-image: url('{{ asset("images/apartaments/$apartament->id/main.jpg") }}'); background-size: cover; margin-bottom: 0px; width: 100px; height: 60px;">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="txt-blue"><b>{{ $apartament->descriptions[0]->apartament_name}}</b></div>
                            <div>{{ $apartament->apartament_city}}@if($apartament->apartament_district != null)({{ $apartament->apartament_district }})@endif</div>
                            <div class="mb-2">{{ $apartament->apartament_address }}</div>
                            <hr class="desktop-none">
                        </div>
                    </div>
                    <div class="mb-3 pb-3 font-12" style="border-bottom: dashed;">
                        <div class="row"><div class="col-4">{{ __('messages.arrival') }}:</div><div class="col-8"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($request->przyjazdDb))) }}</b> (po 15:00)</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.departure') }}:</div><div class="col-8"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($request->powrotDb))) }}</b> (przed 12:00)</div></div>
                        <div class="row"><div class="col-4">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8">{{ $request->ilenocy }}</div></div>
                        <div class="row"><div class="col-4">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8">{{$request->dorosli}} {{trans_choice('messages.adult persons',$request->dorosli)}}, {{$request->dzieci}} dzieci</div></div>
                        <div class="res-description txt-blue mt-3">
                            <a href="apartaments/{{$apartament->descriptions[0]->apartament_link}}">{{ __('messages.change') }}</a>
                        </div>
                    </div>
                    <div class="font-12 sticky-panel-right">
                        <div class="row mb-2"><div class="col-7">{{ __('messages.Payment for stay') }} ({{$request->ilenocy}} {{trans_choice('messages.nights',$request->ilenocy)}}):</div><div class="col-5"><span class="pull-right">{{ number_format($request->payment_all_nights, 2, ',', ' ') }} PLN</span></div></div>
                        <div class="row mb-2"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">{{ number_format($request->payment_final_cleaning, 2, ',', ' ') }} PLN</span></div></div>
                        <div class="row mb-2"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">{{ number_format($request->servicesPrice, 2, ',', ' ') }}  PLN</span></div></div>
                        @foreach($servicesDetails as $servicesDetail)
                            <ul>
                                @if($servicesDetail->with_options == 0)
                                    <li>{{$servicesDetail->name}}<span class="pull-right">{{ number_format($servicesDetail->price, 2, ',', ' ') }} PLN</span></li>
                                @elseif($servicesDetail->with_options == 2)
                                    <li>{{$servicesDetail->name}} dla {{$servicesDetail->adults}} {{trans_choice('messages.persons', $servicesDetail->adults)}} na {{$servicesDetail->nights}} {{trans_choice('messages.days', $servicesDetail->nights)}} <span class="pull-right">{{ number_format($servicesDetail->price, 2, ',', ' ') }} PLN</span></li>
                                @elseif($servicesDetail->with_options == 3)
                                    <li>{{$servicesDetail->name}} <br>dla {{$servicesDetail->adults}} {{trans_choice('messages.persons', $servicesDetail->adults)}} na {{$servicesDetail->nights}} {{trans_choice('messages.days', $servicesDetail->nights)}} <span class="pull-right">{{ number_format($servicesDetail->price, 2, ',', ' ') }} PLN</span></li>
                                @endif
                                {{--trans_choice('messages.adult persons',$request->dorosli)}}, {{$request->dzieci}} dzieci--}}
                            </ul>
                        @endforeach
                        {{--<div class="row mb-2"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">{{ number_format($request->payment_basic_service, 2, ',', ' ') }}  PLN</span></div></div>--}}
                        <div class="row mb-2" style="font-size: 18px"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>{{ number_format($request->fullPrice, 2, ',', ' ') }}  PLN</b></span></div></div>
                    </div>
                </div>
            </div>
        </div>



    </div>


<div class="bg-gray">
    <div class="container py-3">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                <a href="{{ url()->previous() }}" class="pointer-back" style="background-image: url('{{ asset("images/reservations/btn-back.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('messages.Return') }}</b>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 offset-lg-5">
                <a id="nextNotAv" href="#" class="pointer-back next-notAv" style="background-image: url('{{ asset("images/reservations/btn-next-nAv.png") }}')">
                    <div  class="btn" style="width: 100%" >
                        <b>{{ __('messages.Book and pay online') }}</b>
                    </div>
                </a>
                <button id="nextAv" class="btn ml-2 pointer" type="submit" style="display: none;">{{ __('Rezerwuj i opłać online (380,00 PLN)') }}</button>
                {!! Form::close() !!}
                <div id="notAvDescription" style="font-size: 11px; margin-left: 10px; margin-top: 8px">{{ __('messages.First, choose the method of payment') }}</div>
            </div>
        </div>
    </div>
</div>

    <div id="confirm-delete-pop" style="display: none">
        <h3 class="p-3"><b>Czy na pewno chcesz usunąć dane?</b></h3>
        <div class="col-12 mb-4 mt-2">
            <div class="btn btn-black" id="confirm-delete" onclick="deleteItem()" style="width: 100%; font-size: 18px">Potwierdź</div>
            <div class="btn" id="cancel-delete" style="width: 100%; font-size: 18px">Anuluj</div>
        </div>
    </div>

<script>
        var toDelete;

        $("#cancel-delete").on('click', function(){
            $("#confirm-delete-pop").css({'display': 'none'});
        });

        function confirmDelete(id){
            toDelete = id;
            $("#confirm-delete-pop").css({'display': 'block'});
        }

        function deleteItem(){
            $.ajax({
                type: "GET",
                url: `/account/delete/${toDelete}`,
                success: function(data) {
                    location.reload();
                },
                error: function() {
                    console.log("Error in connection with controller");
                },
            });
        }

        $("input[name='wantInvoice']").change(function(){
            if($("input[name='wantInvoice']").is(":checked")){
                $('#invoiceFields').css({'display':'inline'});
            }
            else{
                $('#invoiceFields').css({'display':'none'});
            }
        });

        $("input[name='dontWantAccount']").change(function(){
            if($("input[name='dontWantAccount']").is(":checked")){
                $('#passwordFields').css({'display':'none'});
                $('#password').removeClass("required");
                $('#password2').removeClass("required");
            }
            else{
                $('#passwordFields').css({'display':'inline'});
                $('#password').addClass("required");
                $('#password2').addClass("required");
            }
        });

        $('input').change(function() {
            var isValid = true;
            $('input.required').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false;
                }
                else {
                    if (checkSame() == true || $("input[name='dontWantAccount']").is(":checked") @auth|| 1==1 @endauth ){
                        if($('#accept0').is(":checked") && $('#accept1').is(":checked")){
                            if($('input[type=radio]:checked').length > 0) isValid = true;
                            else{
                                isValid = false;
                                return false;
                            }
                        }
                        else
                        {
                            isValid = false;
                            return false;
                        }
                    }
                    else {
                        isValid = false;
                        return false;
                    }
                }
            });

            if(isValid == true) {
                $('#nextNotAv').css({"display": "none"});
                $('#nextAv').css({"display": "inline-block"});
                //$('span#notAvDescription').hide();

                if($('input[name=payment_method]:checked').val() == 1){
                    $('#nextAv').text('Rezerwuj i opłać online ({{ number_format($request->fullPrice, 2, ',', ' ') }} PLN)');
                    $('div#notAvDescription').html('<div>Zostaniesz przekierowany przekierowany do systemu płatności online (przelew lub karta kredytowa)</div>');
                }

                else if($('input[name=payment_method]:checked').val() == 3){
                    $('#nextAv').text('Rezerwuj i opłać online (100,00 PLN)');
                    $('div#notAvDescription').html('<div>Zostaniesz przekierowany przekierowany do systemu płatności online (przelew lub karta kredytowa)</div>');
                }

                else {
                    $('#nextAv').text('Rezerwuj wstępnie');
                    $('div#notAvDescription').html('<div><div style="color: red;" class=""><div style="float: left;margin-top: 4px; margin-right: 6px"><i class="fa fa-2x fa-exclamation-triangle"></i></div><div><div><b>Czekamy na potwierdzenie wpłaty 90 min</b></div><div style="margin-top: -6px;">Na kolejnej stronie otrzymasz numer rachunku do wpłaty.</div></div></div></div>');
                }

            }
            if(isValid == false){
                $('#nextNotAv').css({"display": "inline-block"});
                $('#nextAv').css({"display": "none"});

                $('#nextAv').text('Rezerwuj i opłać online');
                $('div#notAvDescription').html('<div>Najpierw wybierz sposób zapłaty</div>');
            }

        });

        /*$("#slider-range").slider({
            range: false,
            value: 900,
            min: 0,
            max: 1440,
            step: 30,
            values: [900],
            slide: function (e, ui) {
                var hours1 = Math.floor(ui.values[0] / 60);
                var minutes1 = ui.values[0] - (hours1 * 60);
                if (hours1.length == 1) hours1 = '0' + hours1;
                if (minutes1.length == 1) minutes1 = '0' + minutes1;
                if (minutes1 == 0) minutes1 = '00';

                $('.slider-time').val(hours1 + ':' + minutes1);
            }
        });*/

        var slider = document.getElementById("slider-range");
        godzinaPrzyjazdu = document.getElementById('godzinaPrzyjazdu');
        var initialStartMinute = 900;

        slider = noUiSlider.create(slider,{
            start:[initialStartMinute],
            step:30,
            range:{
                'min':0,
                'max':1440
            }
        });

        var convertValuesToTime = function(values,handle){
            var hours = 0,
                minutes = 0;

            if(handle === 0){
                hours = convertToHour(values[0]);
                minutes = convertToMinute(values[0],hours);
                $("#godzinaPrzyjazdu").val(formatHoursAndMinutes(hours,minutes));
                return;
            }
        };

        var convertToHour = function(value){
            return Math.floor(value / 60);
        };
        var convertToMinute = function(value,hour){
            return value - hour * 60;
        };
        var formatHoursAndMinutes = function(hours,minutes){
            if(hours.toString().length == 1) hours = '0' + hours;
            if(minutes.toString().length == 1) minutes = '0' + minutes;
            return hours+':'+minutes;
        };

        slider.on('update',function(values,handle){
            convertValuesToTime(values,handle);
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
                if(pass.length < 6){
                    $("#passAtLeast").show();
                    return false;
                }
                else $("#passAtLeast").hide();
                return true;
            }

        }

        $(function() {
            $("#password, #password2").on("keyup", function() {
                scorePassword($(this).val());
                checkSame();
            });
        });

        $(function(){
            // Check the initial Poistion of the Sticky Header
            var stickyHeaderTop = $('#stickyheader').offset().top;
            var stickyHeaderRight = $('#stickyheader').offset().left;
            var paymentMethodTop = $('#paymentMethod').offset().top;

            $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop && $(window).scrollTop() < paymentMethodTop) {
                    $('#stickyheader').css({position: 'fixed', top: '0px', left: stickyHeaderRight});
                } else {
                    if($(window).scrollTop() < stickyHeaderTop) $('#stickyheader').css({position: 'static', top: '0px', left: stickyHeaderRight});
                    else $('#stickyheader').css({position: 'absolute', top: paymentMethodTop, left: stickyHeaderRight});
                }
            });

        });

        $(function(){
            $('input').bind('keypress', function(e) {
                if(e.keyCode==13){
                    e.preventDefault();
                    return false;
                }
            });
        });

        $('#main-form').submit(function() {
            var idActive = $(".tab-pane.active").attr('id');
            $(this).append('<input type="hidden" name="idActive" value='+idActive+'>');
            return true;
        });

        //load site with no edit form
        function loadPrevious(){
            location.href = "{!! url()->previous() !!}";
        }

        //check if
        function checkAddNew(){
//check if #addNew has class active
            //if true add class required to input fields
            //if false remove that class
        }

        $("#nameChange").click(function(){
            $('#nameAndSurname').show();
            $('#nameAndSurnameText').hide();
        });

        $("#log-in-inline").click(function(){
            console.log('click');
            $('#login-popup').css('display', 'block');
        });

</script>
@endsection()