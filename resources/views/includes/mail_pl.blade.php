<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-size: 12px; font-family: 'Open Sans', sans-serif;">
<div>
    <table>
        <tr><td colspan="3"><img src="{{ $message->embed(public_path().'/images/reservations/logoHoment.png') }}"></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td><br></td></tr>
        <tr><td style="font-size: 16px;">Witaj,</td></tr>
        <tr><td><br></td></tr>
        <tr><td colspan="3" style="font-size: 16px;">Dziekujemy za rezerwacje.</td></tr>
        <tr><td><br></td></tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <td><img src="{{ $message->embed(public_path().'/images/apartaments/'.$apartament_id.'/mail.jpg') }}"></td>
            <td colspan="2">
                <span style="color: #007bff; font-size: 20px;"><b>{{$apartament_name}}</b></span><br>
                <span style="font-size: 15px">{{$apartament_city}}, {{$apartament_district}}</span><br>
                <span style="font-size: 15px">{{$apartament_address}}</span><br>
            </td>
        </tr>
        <tr><td colspan="2"><span style="font-size: 12px">GPS: N 48° 12' 39.90'' E 16° 23' 1.82''</span></td></tr>
        <tr><td colspan="3"><hr></td></tr>
        <tr style="font-size: 15px">
            <td></td><td>Przyjazd:</td><td><b>{{strtolower(strftime("%a, %d %b %Y", strtotime($reservation_arrive_date)))}}</b> (po {{$reservation_arrive_time}})</td>
        </tr>
        <tr style="font-size: 15px">
            <td></td><td>Wyjazd:</td><td><b>{{strtolower(strftime("%a, %d %b %Y", strtotime($reservation_departure_date)))}}</b> ({{$apartament_checkout_time}})</td>
        </tr>
        <tr style="font-size: 14px">
            <td></td><td>Noce:</td><td>{{$reservation_nights}}</td>
        </tr>
        <tr style="font-size: 14px">
            <td></td><td>Osoby:</td><td>{{$reservation_persons}} {{trans_choice('messages.adult persons', $reservation_persons)}}, {{$reservation_kids}} dzieci</td>
        </tr>
        <tr><td><br></td></tr>
        @if($reservation_status == 0)
            <tr style="font-size: 15px">
                <td></td><td><b>Do zapłaty: </b></td><td><b>{{$payment_to_pay}} PLN*</b></td>
            </tr>
        @elseif($payment_to_pay > 0)
            <tr style="font-size: 15px">
                <td></td><td><b>Do zapłaty: </b></td><td><b>{{$payment_to_pay}} PLN*</b></td>
            </tr>
        @else
            <tr style="font-size: 15px">
                <td></td><td><b>Zapłacono: </b></td><td><b>{{$payment_full_amount}} PLN*</b> ({{date("d.m.Y", strtotime($updated_at))}})</td>
            </tr>
        @endif
        <tr><td><br></td></tr>
        <tr>
            <td></td><td></td>
        </tr>
        <tr style="font-size: 14px">
            <td></td><td>Koszt pobytu:</td><td> {{$payment_full_amount}} PLN</td>
        </tr>
        @if($payment_to_pay > 0)
        <tr style="font-size: 14px">
            <td></td><td>Zaliczka: </td><td>{{$payment_full_amount - $payment_to_pay}} PLN* (zapłacono, {{date("d.m.Y", strtotime($updated_at))}})</td>
        </tr>
        @endif
        <tr><td><br></td></tr>
        <tr>
            <td></td>
            <td colspan="2" style="font-size: 11px">
                * Właściciel może pobrać na miejscu dodatkowe opłaty -<br>
                np: opłatę klimatyczną, parking itd  (sprawdź opis oferty).
            </td>
        </tr>
        <tr><td><br><br><br><br></td></tr>
        <tr>
            <td style="font-size: 12px;">Kontakt:<br>Justyna Mroczek</td>
            <td colspan="2">
                <img  src="{{ $message->embed(public_path().'/images/reservations/phoneInMail1.png') }}">
                <img  src="{{ $message->embed(public_path().'/images/reservations/phoneInMail2.png') }}">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <img  src="{{ $message->embed(public_path().'/images/reservations/envelopeInMail.png') }}">
            </td>
        </tr>
        <tr><td><br><br><br><br></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td></td><td colspan="2" style="font-size: 11px">Kontakt: 22/565 66 66 (pn-pt 9:00-17:00), <span style="color: #8fdf82">kontakt@visitzakopane.pl</span></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td colspan="3"><span style="font-size: 11px; color: gray">Ta wiadomość została wysłana przez Homerent.</span></td></tr>
    </table>

</div>
</body>
</html>