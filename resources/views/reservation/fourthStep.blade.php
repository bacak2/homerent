@extends ('includes.reservations')

@section('reservation.content')
    @if(!(Request::is('*/my-reservations*')))
        <div class="container flex-box mb-2">
            <div class="mobile-none font-12" id="Rpath">
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                    <span class="active number">1</span>
                    <span class="activeBold ml-2">{{ __('messages.offer') }}</span>
                </div>
                <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                    <span class="active number">2</span>
                    <span class="activeBold ml-2">{{ __('messages.your data') }}</span>
                </div>
                <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/fullBlack.png") }}'>
                    <span class="active number">3</span>
                    <span class="activeBold ml-2">{{ __('messages.payment') }}</span>
                </div>
                <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
                <div class="reservation-path">
                    <img src='{{ asset("images/reservations/thisStepBlack.png") }}'>
                    <span class="active number">4</span>
                    <span class="activeBold ml-2">{{ __('messages.confirmation') }}</span>
                </div>
            </div>
            <div class="desktop-none font-11 row no-gutters" id="Rpath"><div class="bold col">{{ __('messages.offer') }}</div><div class="pr-2"><img src='{{ asset("images/reservations/lineActiveMobile.png") }}'></div><div class="bold col">{{ __('messages.your data') }}</div><div class="pr-3"><img src='{{ asset("images/reservations/lineActiveMobile.png") }}'></div><div class="bold col">{{ __('messages.payment') }}</div><div class="pr-2"><img src='{{ asset("images/reservations/lineActiveMobile.png") }}'></div><div class="bold col">{{ __('messages.confirmation') }}</div></div>
        </div>
    @endif
<div class="container">
    @if(!(Request::is('*/my-reservations*')))
        <?php $_GET['status'] = $_GET['status'] ?? 0 ?>
        @if(Request::has('servicesAdded') || $_GET['status'] == 2 )
        <h1 class="mt-4 h1-reservation">{{ __('messages.reservation') }} (nr {{$reservation[0]->id}})</h1>
        <div class="row reservation-item font-m-13 px-2 py-1 mb-4 mx-0" id="services-confirmed">
            <i class="fa fa-3x fa-check-circle"></i>
            <span class="mt-2 ml-2">Zamówione usługi dodatkowe zostały dodane do rezerwacji. <a href="#details">Zobacz szczegóły ↓</a></span>
        </div>
        @elseif($reservation[0]->reservation_status == 1 && $_GET['status'] != 2)
        <h1 class="mt-4 h1-reservation">{{ __('messages.reservation') }} (nr {{$reservation[0]->id}})</h1>
        <div class="row reservation-item font-m-13 px-2 py-1 mb-4 mx-0" id="reservation-confirmed">
            <i class="fa fa-3x fa-check-circle"></i>
            <span class="mt-2 ml-2">Zarezerwowano obiekt wg wybranych parametrów. Na adres e-mail {{$reservation[0]->email}} wysłaliśmy potwierdzenie.</span>
        </div>
        @elseif($reservation[0]->reservation_status == 0)
        <h1 class="mt-4 h1-reservation">{{ __('messages.reservation') }} {{ __('messages.preliminary') }} (nr {{$reservation[0]->id}})</h1>
        <div class="row reservation-item font-m-13 px-2 py-1 mb-4 mx-0">
            <div class="col-1"><i class="fa fa-3x fa-exclamation-triangle"></i></div>
            <div class="col-11">
                <span style="color: red">
                    <div class="row">Uprzejmie dziękujemy za dokonanie rezerwacji. <b>Ma ona status wstępnej.</b></div>
                    <div class="row">Prosimy o jej niezwłoczne opłacenie na nasze konto.</div>
                    <div class="row"><b>W przypadku braku wpłaty w ciągu 30 minut rezerwacja zostanie anulowana automatycznie.</b></div>
                    <div class="row">Prosimy o przesłanie dowodu wpłaty na adres email: rezerwacje@visitzakopane.pl.</div>
                </span>
                <div class="row mt-2">
                    <b>Nr konta do wpłaty: </b> PL 20 1050 1038 1000 0090 6587 9562
                    <span style="margin-left: 60px"></span><b>Kod SWIFT: </b> INGBPLPW
                </div>
                <div class="row"><b>Dane: </b> VISITzakopane.pl, ul. Tetmajera 35 lok. 12, 34-500 Zakopane, Poland</div>
                <div class="row"><b>Tytuł przelewu: </b> Rezerwacja nr {{$reservation[0]->id}}</div>
                <div class="row"><b>Kwota: </b> całość {{$reservation[0]->payment_to_pay}} PLN lub zaliczka 100,00 PLN</div>
            </div>
        </div>
        @endif
    @else
        <div class="row mb-4 mb-md-2 mb-lg-0">
            <div class="col-8 col-md-6">
                <h1 class="h1-reservation">{{ __('messages.reservation') }} (nr {{$reservation[0]->id}})</h1>
            </div>
            <div class="col-4 col-md-6">
                <span class="pull-right">
                    <div class="d-inline-block">
                        <div class="d-inline-block send-news-friends mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                            <img style="padding: 7px 9px; max-width: 36px" src="{{asset('images/favourites/Envelop.png')}}">
                        </div>
                        <div class="d-none d-md-inline-block send-news-friends font-13 txt-blue" style="margin-top: 6px;">Wyślij znajomemu</div>
                    </div>
                    <div class="d-none d-md-inline-block">|</div>
                    <div class="d-none d-md-inline-block">
                        <div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                            <img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/favourites/Pdf_file.png')}}">
                        </div>
                        <a href="{{route('aboutUs.printPdf', 1)}}" class="d-inline-block font-13 txt-blue" style="margin-top: 6px;">Zapisz</a>
                    </div>
                </span>
            </div>
        </div>
    @endif
    <div class="row reservation-item font-m-13 py-2 mx-0">
        <div class="col-lg-2 pr-0 d-none d-lg-block">
            <img class="img-fluid" src='{{ asset("images/apartaments/$apartament->id/main.jpg") }}'>
        </div>
        <div class="col-lg-10 col-sm-12">
            <div class="row">
                <div class="col-4 pr-0 d-block d-lg-none">
                    <img class="img-fluid" src='{{ asset("images/apartaments/$apartament->id/main.jpg") }}'>
                </div>
                <div class="col-8 col-lg-3">
                    <div class="txt-blue font-22-reservation font-m-13"><b>{{ $apartament->descriptions[0]->apartament_name }}</b></div>
                    <div class="mb-2">{{ $apartament->apartament_city}} @if($apartament->apartament_district != null)({{ $apartament->apartament_district }})@endif</div>
                    <div class="mb-2">{{ $apartament->apartament_address }}</div>
                </div>
                <div class="col-12 desktop-none">
                    GPS: {{ $apartament->apartament_gps }}
                    <hr>
                </div>
                <div class="col-lg-4 col-sm-6 pl-lg-0">
                    <div class="row"><div class="col-4 col-lg-3">{{ __('messages.arrival') }}:</div><div class="col-8 col-lg-9 pr-0"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($reservation[0]->reservation_arrive_date))) }}</b> (po {{$reservation[0]->reservation_arrive_time}})</div></div>
                    <div class="row"><div class="col-4 col-lg-3">{{ __('messages.departure') }}:</div><div class="col-8 col-lg-9 pr-0"><b>{{ strtolower(strftime("%a, %d %b %Y", strtotime($reservation[0]->reservation_departure_date))) }}</b> (przed 12:00)</div></div>
                    <div class="row"><div class="col-4 pr-lg-0 font-12">{{ ucfirst(__('messages.number of nights')) }}:</div><div class="col-8" style="font-size: 12px">{{ $reservation[0]->reservation_nights }}</div></div>
                    <div class="row"><div class="col-4 pr-lg-0 font-12">{{ __('messages.Number of') }} {{ __('messages.people')}}:</div><div class="col-8" style="font-size: 12px">{{$reservation[0]->reservation_persons}} {{trans_choice('messages.adult persons',$reservation[0]->reservation_persons)}}, {{$reservation[0]->reservation_kids}} dzieci</div></div>
                    <hr class="d-sm-none">
                </div>
                <div class="col-lg-5 col-sm-6">
                    {{--wstępna--}}
                    @if($reservation[0]->reservation_status == 0)
                        <div class="row mb-2"><div class="col-4"><b>Do zapłaty:</b></div><div class="col-4"><b>{{$reservation[0]->payment_to_pay}} PLN</b></div></div>
                        <div class="row mb-2" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">{{$reservation[0]->payment_full_amount}} PLN*</div><div class="col-4"><a href="#details">Szczegóły ↓</a></div></div>
                    {{--zapłacono zaliczkę--}}
                    @elseif($reservation[0]->payment_to_pay > 0)
                        <div class="row mb-2"><div class="col-4"><b>Do zapłaty:</b></div><div class="col-4"><b>{{$reservation[0]->payment_to_pay}} PLN</b></div><div class="col-4"><span class="font-11" style="display: block;">Można zapłacić online lub przy odbiorze kluczy.</span></div></div>
                        <div class="row mb-2 font-12"><div class="col-4">{{ __('messages.Advance') }}:</div><div class="col-4">{{$reservation[0]->payment_full_amount - $reservation[0]->payment_to_pay}} PLN</div><div class="col-4 font-11">zapłacono, {{date("d.m.Y", strtotime($reservation[0]->updated_at))}}</div></div>
                        <div class="row mb-2 font-12"><div class="col-4">Koszt pobytu:</div><div class="col-4">{{$reservation[0]->payment_full_amount}} PLN*</div><div class="col-4"><a href="#details">Szczegóły ↓</a></div></div>
                    {{--zapłacono całość--}}
                    @elseif($reservation[0]->reservation_status == 1)
                        <div class="row mb-2"><div class="col-4"><b>Zapłacono:</b></div><div class="col-8"><b>{{$reservation[0]->payment_full_amount}} PLN </b><span class="font-12">({{date("d.m.Y", strtotime($reservation[0]->updated_at))}})</span></div></div>
                        <div class="row mb-2" style="font-size: 12px;"><div class="col-4">Koszt pobytu:</div><div class="col-4">{{$reservation[0]->payment_full_amount}} PLN*</div><div class="col-4"><a href="#details">Szczegóły ↓</a></div></div>
                    @endif
                    <div class="row mb-2">
                        @if($availableServices->count() == 0 && $reservation[0]->payment_to_pay > 0)
                        <div class="col pr-0">
                            <form name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="{{$reservation[0]->payment_to_pay}}" />
                                <input type="hidden" name="typ" value="3" />
                                <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                <input type="submit" style="width: 100%;height: 100%;" class="btn btn-to-pay" value="Zapłać całość {{$reservation[0]->payment_to_pay}} PLN">
                            </form>
                        </div>
                        {{--pokaż zaliczkę do zapłaty--}}
                        @if($reservation[0]->reservation_status == 0)
                        <div class="col">
                            <form id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="100" />
                                <input type="hidden" name="typ" value="3" />
                                <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                <input type="submit" style="width: 100%;height: 100%;" class="btn btn-to-pay" value="Zapłać zaliczkę 100 PLN">
                            </form>
                        </div>
                        @endif
                        <div class="col pl-3">
                            <button class="btn btn-reservation-gray" id="cancel-reservation">Anuluj rezerwację</button>
                        </div>
                        @else
                        <div class="col pr-0">
                            {{--<button class="btn btn-to-pay" style="width: 100%;height: 100%;">Zapłać</button>
                            <form name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="{{$reservation[0]->payment_full_amount}}" />
                                <input type="hidden" name="typ" value="3" />
                                <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                <input type="submit" class="btn btn-to-pay" value="Zapłać całość {{$reservation[0]->payment_full_amount}} PLN">
                            </form>
                            <form id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="100" />
                                <input type="hidden" name="typ" value="3" />
                                <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                <input type="submit" class="btn btn-to-pay" value="Zapłać zaliczkę 100 PLN">
                            </form>
                            --}}
                            {{--zapłacono zaliczkę--}}
                            @if($reservation[0]->payment_to_pay != 0 && $reservation[0]->payment_to_pay != $reservation[0]->payment_full_amount && $reservation[0]->reservation_status == 1)
                                <form name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                    <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                    <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="{{$reservation[0]->payment_to_pay}}" />
                                    <input type="hidden" name="typ" value="3" />
                                    <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                    <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                    <input type="submit" class="btn btn-to-pay" value="Zapłać całość {{$reservation[0]->payment_to_pay}} PLN">
                                </form>
                            @elseif($reservation[0]->reservation_status == 1)
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-to-pay dropdown-toggle" type="button" data-toggle="dropdown" style="width: 100%; height: 100%">Zapłać<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu reservation-4th">
                                        <li>
                                            <form name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                                <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                                <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="{{$reservation[0]->payment_to_pay}}" />
                                                <input type="hidden" name="typ" value="3" />
                                                <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                                <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                                <input type="submit" class="btn btn-to-pay" value="Zapłać całość {{$reservation[0]->payment_to_pay}} PLN">
                                            </form>
                                        </li>
                                        <li>
                                            <form id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
                                                <input type="hidden" name="id" value="734129" /> <input type="hidden" name="opis" value="Opłata za pobyt w {{ $apartament->descriptions[0]->apartament_name }}" />
                                                <input type="hidden" name="control" value="{{$reservation[0]->id}}" /> <input type="hidden" name="amount" value="100" />
                                                <input type="hidden" name="typ" value="3" />
                                                <input type="hidden" name="URL" value="{{route('reservations.fourthStepAfterDotpay', ['idAparment' => $reservation[0]->apartament_id, 'idReservation' => $reservation[0]->id, 'status' => 'OK'])}}"/>
                                                <input type="hidden" name="URLC" value="{{route('reservations.afterOnlinePaymentPOST')}}"/>
                                                <input type="submit" class="btn btn-to-pay" value="Zapłać zaliczkę 100 PLN">
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <a href="{{route('services.firstStep', [$reservation[0]->apartament_id, $reservation[0]->id, 0])}}" id="add-new-services" class="btn btn-reservation-gray">Dokup usługi</a>
                        </div>
                        <div class="col pl-0 pl-sm-3 pl-md-0 mt-sm-2 mt-md-0">
                            <button class="btn btn-reservation-gray" id="cancel-reservation">Anuluj rezerwację</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-lg-12 col-sm-12 pt-2 mt-0 mt-lg-2bt-md-solid">
            <div class="row">
                <div class="col-sm-6 col-md-12 col-lg-2 mb-2 font-14 font-m-12">
                    <span>
                        Kontakt:<br class="d-none d-lg-inline">
                        Justyna Mroczek
                    </span>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-2 mb-2 px-lg-1">
                    <div class="contact-item"><i class="fa fa-lg fa-phone" style="margin-right: 10px"></i>+48 600 000 000</div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-2 mb-2 px-lg-2">
                    <div class="contact-item"><i class="fa fa-lg fa-phone" style="margin-right: 10px"></i>+48 600 000 000</div>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-3 mb-2 px-lg-1">
                    <div class="contact-item"><i class="fa fa-lg fa-envelope" style="margin-right: 10px"></i>justyna.mroczek@gmail.com</div>
                </div>
                <div class="col-lg-3 mb-2">
                    <span style="font-size: 11px; display: block;">
                        * Właściciel może pobrać na miejscu dodatkowe opłaty - np: opłatę klimatyczną, parking itd  (sprawdź <a href="{{ route('apartamentInfo', ['link' => $apartament->descriptions[0]->apartament_link ]) }}">opis oferty</a>).
                    </span>
                </div>
            </div>
        </div>
    </div>
@auth
    @if(strtotime($reservation[0]->reservation_departure_date) < strtotime(date("Y-m-d")))
        <span id="opinion">
            <h2 class="h2-reservation my-4">Ocena</h2>
            <div class="row mb-5">
                <div class="col-md-2 mb-3 mb-md-0"><a class="btn btn-black font-m-13" href="{{url()->current()}}/opinion" style="width: 100%">Oceń teraz</a></div>
                <div class="col-md-10">
                    <div class="mb-2 font-12">Twoja ocena i opinia pomogą wybierać innym w przyszłości.</div>
                    <div class="font-12">A dodatkowo zyskujesz 5% rabatu lub 50 pln zniżki na kolejną rezerwację.</div>
                </div>
            </div>
        </span>
    @endif
@endauth
    <div class="row mt-4">
        <div class="col-lg-4 col-sm-12">
            <h2 class="mb-3 h2-reservation">Apartament</h2>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Check-in') }}:</div><div class="col-8">{{ $apartament->apartament_registration_time }}</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Check-out') }}:</div><div class="col-8">{{ $apartament->apartament_checkout_time }}</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Cancellation / prepayment') }}:</div><div class="col-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Animals') }}:</div><div class="col-8">Zwierzęta są akceptowane na życzenie. Mogą obowiązywać dodatkowe opłaty</div></div>
                    <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Payment for stay') }}:</div><div class="col-8">Cena zakwaterowania nie obejmuje opłaty za zużycie energii elektrycznej oraz opłaty klimatycznej.</div></div>
                    <div class="row mx-0 mb-3 mb-lg-0"><a class="btn btn-more-info font-13" href="{{ route('apartamentInfo', ['link' => $apartament->descriptions[0]->apartament_link ]) }}">Więcej informacji o obiekcie</a></div>
        </div>

        <div class="col-lg-8 col-sm-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#showMap">Mapa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#showStreetview">Okolica (Street view)</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="showMap" class="tab-pane active">
                    <form name="wskazowki" action="#" onsubmit="znajdz_wskazowki(); return false;">
                        <div class="row">
                            <div class="col-12" style="font-size: 16px"><b>{{  $apartament->descriptions[0]->apartament_name or '' }}</b></div>
                            <div class="col-12 mb-4" style="font-size: 14px">{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}</div>
                            <div class="col-12 mb-2" style="font-size: 14px">GPS: {{ $apartament->apartament_gps }}</div>
                        </div>
                        <div class="row my-2 mx-0" style="position: relative;">
                            <span class="col-12 px-0"style="font-size: 14px; margin-top: 5px">Wskazówki dojazdu: </span>
                            <div class="col-6 col-md-3 px-0">
                                <input class="font-12" name="skad" id="skad" style="width: 100%; height: 100%" placeholder="Lokalizacja początkowa" type="text">
                            </div>
                            <div class="col-3 col-md-2 px-1">
                                <input class="btn btn-reservation-gray" style="width: 100%; height: 100%; margin-left: 0px;" value="Pokaż" type="submit">
                            </div>
                            <div class="col-3 col-md-2 col-lg-1 col-xl-2 font-12 pr-0 mr-lg-3">
                                <div id="distance" class="row" style="font-weight: bold"></div>
                                <div id="duration" class="row"></div>
                            </div>
                    </form>
                            <form id="printDirections" action="{{route('printPdf')}}" class="mt-2 mt-md-0 pl-0" method="POST" name="wskazowki-print">
                                <input type='hidden' id='wskazowkiContent' name='wskazowkiContent' value='' />
                                <input id="drukujWskazowki" class="btn btn-reservation-gray ml-0" value="Drukuj wskazówki dojazdu" style="display: none" type="submit">
                            </form>
                        </div>
                    <div id="wskazowki"></div>
                    <div id="mapka" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
                </div>
                <div id="showStreetview" class="tab-pane">
                    <div id="streetView" style="width: 100%; height: 500px; margin-bottom: 30px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-5">
        <div class="col-md-6 col-lg-4">
            <h2 class="mb-3 h2-reservation">Zarezerwował</h2>
            <div class="row fs12"><div class="col-4">{{ __('messages.Data') }}:</div><div class="col-8">{{ $reservation[0]->name }} {{ $reservation[0]->surname }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->address }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->postcode }} {{ $reservation[0]->place }}</div></div>
            <div class="row mb-3 fs12"><div class="col-8 offset-4">{{ $reservation[0]->country }}</div></div>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Cellphone number') }}:</div><div class="col-8">{{ $reservation[0]->phone }}</div></div>
            <div class="row mb-3 fs12"><div class="col-4">{{ __('messages.Email address') }}:</div><div class="col-8">{{ $reservation[0]->email }}</div></div>
            @if($reservation[0]->invoice != NULL)
            <div class="row fs12"><div class="col-4">Faktura na dane:</div><div class="col-8">{{ $reservation[0]->company_name }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->address_invoice }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->postcode_invoice }}</div></div>
            <div class="row fs12"><div class="col-8 offset-4">{{ $reservation[0]->place_invoice }}</div></div>
                @if($reservation[0]->nip != NULL)<div class="row fs12"><div class="col-8 offset-4">NIP: {{ $reservation[0]->nip }}</div></div>@endif
            @endif
        </div>
        <div class="col-md-6 col-lg-4 font-12 additional-service-list">
            <h2 class="mb-3 h2-reservation" id="details">Koszt pobytu</h2>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Payment for stay') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_all_nights}} PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Final cleaning') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_final_cleaning}} PLN</span></div></div>
            <div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Additional services') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_additional_services}} PLN</span></div></div>
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
            {{--<div class="row mb-3 fs12"><div class="col-7">{{ __('messages.Payment for service') }}:</div><div class="col-5"><span class="pull-right">{{$reservation[0]->payment_basic_service}} PLN</span></div></div>--}}
            <div class="row mb-3 font-m-16 font-18"><div class="col-7"><b>{{ __('messages.fprice') }}</b></div><div class="col-5"><span class="pull-right"><b>{{$reservation[0]->payment_full_amount}} PLN</b></span></div></div>
        </div>
        <div class="col-md-6 col-lg-4 col-sm-12">
            @if($availableServices->count() != 0 || $servicesDetails->count() != 0)
                <h2 class="mb-3 h2-reservation">Usługi dodatkowe</h2>
                @if($availableServices->count() != 0)
                    <h3 class="h3-reservation">Dostępne</h3>
                    @foreach($availableServices as $availableService)
                        <div class="row mb-3 fs12">
                            <div class="col-7 pl-0">
                                <div class="col-12 font-14">{{$availableService->name}}</div>
                                <div class="col-12 font-11">{{$availableService->description}}</div>
                            </div>
                            <div class="col-5"><span class="pull-right"><a href="{{route('services.firstStep', [$availableService->id_apartament, $reservation[0]->id, $availableService->id])}}" class="btn btn-reservation-gray">Zamów</a></span></div>
                        </div>
                    @endforeach
                @endif

                @if($servicesDetails->count() != 0)
                    <h3 class="h3-reservation">Zamówione</h3>
                    @foreach($servicesDetails as $servicesDetail)
                        <ul class="font-14 additional-service-list-av">
                            @if($servicesDetail->with_options == 0)
                                <li>{{$servicesDetail->name}} ({{ number_format($servicesDetail->price, 2, ',', ' ') }} zł)</li>
                            @elseif($servicesDetail->with_options == 2)
                                <li>{{$servicesDetail->name}} dla {{$servicesDetail->adults}} {{trans_choice('messages.persons', $servicesDetail->adults)}} na {{$servicesDetail->nights}} {{trans_choice('messages.days', $servicesDetail->nights)}} ({{ number_format($servicesDetail->price, 2, ',', ' ') }} zł)</li>
                            @elseif($servicesDetail->with_options == 3)
                                <li>{{$servicesDetail->name}} dla {{$servicesDetail->adults}} {{trans_choice('messages.persons', $servicesDetail->adults)}} na {{$servicesDetail->nights}} {{trans_choice('messages.days', $servicesDetail->nights)}} ({{ number_format($servicesDetail->price, 2, ',', ' ') }} zł)</li>
                            @endif
                            {{--trans_choice('messages.adult persons',$request->dorosli)}}, {{$request->dzieci}} dzieci--}}
                        </ul>
                    @endforeach
                @endif
                @if($reservation[0]->reservation_additional_message != NULL)
                    <span class="font-14">Wiadomość dotycząca usług:<br></span>
                    <span class="font-12">{{$reservation[0]->reservation_additional_message}}</span>
                @endif
            @endif
        </div>
    </div>
</div>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBBEtTo5au09GsH6EvJhj1R_uc0BpTLVaw&language={{$language}}" type="text/javascript"></script>
<script type="text/javascript">

    var mapa;
    var dymek = new google.maps.InfoWindow();
    var greenMarkers = [];
    var trasa  		 = new google.maps.DirectionsService();
    var trasa_render = new google.maps.DirectionsRenderer();
    var wspolrzedne = new google.maps.LatLng({{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }});

    function mapaStart()
    {
        var greenIcon = new google.maps.MarkerImage('{{ asset("images/map/u3576.png") }}');
        var opcjeMapy = {
            zoom: 13,
            center: wspolrzedne,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy);
        trasa_render.setMap(mapa);
        trasa_render.setPanel(document.getElementById('wskazowki'));
        var marker1 = dodajZielonyMarker( {{ $apartament->apartament_geo_lat }}, {{ $apartament->apartament_geo_lan }},'', greenIcon);
    }

    function znajdz_wskazowki()
    {
        $("#drukujWskazowki").hide();
        $("#wskazowkiContent").val("");
        var dane_trasy =
        {
            origin: document.getElementById('skad').value,
            destination: "{{ $apartament->apartament_city }}, {{ $apartament->apartament_address }}",
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

        trasa.route(dane_trasy, obsluga_wskazowek);
        greenMarkers[0].setMap(null);
    }

    function obsluga_wskazowek(wynik, status)
    {
        if(status != google.maps.DirectionsStatus.OK || !wynik.routes[0])
        {
            alert('Nie znaleziono lokalizacji początkowej');
            return;
        }
        else
        {
            trasa_render.setDirections(wynik);
            $("#distance").text(wynik.routes[0].legs[0].distance.text);
            $("#duration").text(wynik.routes[0].legs[0].duration.text);
            $('#wskazowki').css({display: 'block'});
            setTimeout(function(){
                var pdfContent = $("#wskazowki").html();
                $("#wskazowkiContent").val(pdfContent);
                $("#drukujWskazowki").show();
            }, 2000);
        }

    }

    function dodajZielonyMarker(lat,lng,txt, ikona)
    {
        var opcjeMarkera =
        {
            position: new google.maps.LatLng(lat,lng),
            map: mapa,
            icon: ikona
        }
        var marker = new google.maps.Marker(opcjeMarkera);
        marker.txt=txt;

        greenMarkers.push(marker);
        return marker;
    }

    function setStreetView(){

        var mapS = new google.maps.Map(document.getElementById('streetView'), {
            center: wspolrzedne,
            zoom: 14
        });

        var panorama = new google.maps.StreetViewPanorama(
            document.getElementById('streetView'), {
                position: wspolrzedne,
                pov: {
                    heading: 34,
                    pitch: 0
                },
                addressControl: false,
            });
        mapS.setStreetView(panorama);
    }

    $(document).ready(function(){
        mapaStart();
        setStreetView();
    });

    $(document).ready(function(){
            var reservationId = {{$reservation[0]->id}};
            $.ajax({
                type: "GET",
                url: '/sendemail',
                dataType : 'json',
                data: {
                    reservationId: reservationId,
                },
                success: function() {
                    console.log("Mail sended");
                },
                error: function(data) {
                    console.log(data);
                },
            });
    });

    $(document).ready(function(){

        $("#cancel-reservation").click(function(){
            if(confirm("Czy na pewno chcesz anulować rezerwację?")) cancelReservation();
        });

    });

    function cancelReservation(){
        var reservationId = {{$reservation[0]->id}};
        $.ajax({
            type: "GET",
            url: '/cancel-reservation',
            dataType : 'json',
            data: {
                reservationId: reservationId,
            },
            success: function() {
                window.location.replace("{{route('index')}}");
            },
            error: function(data) {
                console.log(data);
            },
        });
    }
</script>

@endsection()