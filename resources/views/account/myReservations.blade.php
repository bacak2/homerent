@extends ('layout.layout')

@section('title', '- '.Auth::user()->name.'- '.__('messages.My account') )

@section('content')
<div class="container">
    <div class="row mt-4"><h3><b>Rezerwacje</b></h3></div>
    @foreach($users_reservations as $reservation)
    <div class="row minH-90 py-3">
        <div class="col-lg-1 col-4"  style="background-image: url('{{ asset("images/apartaments/$reservation->apartament_id/1.jpg") }}'); background-size: cover;"></div>
        <div class="col-lg-3 col-8">
            {{ $reservation->apartament_name }}<br>
            {{ $reservation->apartament_city }}<br>
            {{ $reservation->apartament_address }}
        </div>
        <div class="col-lg-1 col-4">{{ $reservation->reservation_arrive_date }}</div>
        <div class="col-lg-1 col-4">Liczba nocy: {{ $reservation->reservation_nights }}</div>
        <div class="col-lg-1 col-4">Rezerwacja</div>
        <div class="col-lg-1 col-6">Opłata za pobyt</div>
        <div class="col-lg-1 col-6">Do zapłaty</div>
        <div class="col-lg-1 col-4">Telefon</div>
        <div class="col-lg-1 col-4">Mail</div>
        <div class="col-lg-1 col-4">
            <a href="{{ route('account.reservationDetail',['idAparment' => $reservation->apartament_id, 'idReservation' => $reservation->id]) }}">Szczegóły</a>
            <a href="{{ route('apartamentInfo',['link' => $reservation->apartament_link]) }}">Rezerwuj ponownie</a>
        </div>
    </div>
    @endforeach
</div>
@endsection