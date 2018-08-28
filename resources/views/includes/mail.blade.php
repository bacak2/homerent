<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-size: 12px; font-family: 'Open Sans', sans-serif;">
<span style="font-size: 24px; font-family: 'Open Sans', sans-serif;">Otozakopane</span>
<hr style="border: 0 none;  border-top: 2px dashed black;  background: none;">
<br>
<span style="font-size: 16px;">
    Witaj,<br><br>
    Dziekujemy za rezerwacje.<br><br>
</span>
<div style="padding: 20px">
    <div style="font-size: 16px; margin-bottom: 20px">
        <img style="margin-right: 20px; width: 160px; height: 90px; float: left;" src="{{ $message->embed(public_path().'/images/apartaments/'.$apartament_id.'/mail.jpg') }}">
        <span style="line-height: 30px">
            <div style="color: #007bff; font-size: 20px; font-weight: bold;">{{$apartament_name}}</div>
            {{$apartament_city}}, {{$apartament_district}}<br>
            {{$apartament_address}}<br>
        </span>
        <div style="clear: both; margin-bottom: 16px"></div>
        <span style="font-size: 12px">GPS: N 48° 12' 39.90'' E 16° 23' 1.82''</span>
    </div>
    <hr>
    <div style="padding: 20px">
        <table style="margin-left: auto; margin-right: auto;">
            <tr>
                <td>Przyjazd:</td><td><b>{{$reservation_arrive_date}}</b> (po {{$reservation_arrive_time}})</td>
            </tr>
            <tr>
                <td>Wyjazd:</td><td><b>{{$reservation_departure_date}}</b> ({{$apartament_checkout_time}})</td>
            </tr>
            <tr style="font-size: 14px">
                <td>Noce:</td><td>{{$reservation_nights}}</td>
            </tr>
            <tr style="font-size: 14px">
                <td>Osoby:</td><td>{{$reservation_persons}} osoby dorosłe, {{$reservation_kids}} dzieci</td>
            </tr>
            <tr style="height:20px;">
                <td></td>
            </tr>
            <tr>
                <td><b>Do zapłaty: </b></td><td><b>300,00 PLN*</b></td>
            </tr>
            <tr style="height:20px;">
                <td></td>
            </tr>
            <tr style="font-size: 14px">
                <td>Koszt pobytu:</td><td>400,00 PLN</td>
            </tr>
            <tr style="font-size: 14px">
                <td>Zaliczka:</td><td>100,00 PLN (zapłacono, 12.03.2014)</td>
            </tr>
            <tr style="height:20px;">
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 11px">
                    * Właściciel może pobrać na miejscu dodatkowe opłaty -<br>
                    np: opłatę klimatyczną, parking itd  (sprawdź opis oferty).
                </td>
            </tr>
        </table>

        <br><br><br><br><br>

        <table style="margin-left: auto; margin-right: auto; max-width: 740px;">
            <tr>
                <td style="font-size: 12px; width: 150px; vertical-align: top;">Kontakt:<br>Justyna Mroczek</td>
                <td>
                    <div>
                        <div style="margin-right: 20px; margin-bottom: 16px; display: inline-block; font-size: 12px; padding-left: 10px; padding-right: 10px; border-radius: 5px; border: solid 1px; background-color: #e7e7e7;">
                            <div class="contact-item" style=" text-align: center; display: table-row; vertical-align: middle;">
                                <div style="vertical-align: middle; display: table-cell"><img src="{{ $message->embed(public_path().'/images/reservations/phone.png') }}"></div>
                                <div style="vertical-align: middle; display: table-cell">+48 600 000 000</div>
                            </div>
                        </div>
                        <div style="margin-right: 20px; margin-bottom: 16px; display: inline-block; font-size: 12px; padding-left: 10px; padding-right: 10px; border-radius: 5px; border: solid 1px; background-color: #e7e7e7;">
                            <div class="contact-item" style=" text-align: center; display: table-row; vertical-align: middle;">
                                <div style="vertical-align: middle; display: table-cell"><img src="{{ $message->embed(public_path().'/images/reservations/phone.png') }}"></div>
                                <div style="vertical-align: middle; display: table-cell">+48 12 431 31 31</div>
                            </div>
                        </div>
                        <div style="margin-right: 20px; margin-bottom: 16px; display: inline-block; font-size: 12px; padding-left: 10px; padding-right: 10px; border-radius: 5px; border: solid 1px; background-color: #e7e7e7;">
                            <div class="contact-item" style=" text-align: center; display: table-row; vertical-align: middle;">
                                <div style="vertical-align: middle; display: table-cell"><img src="{{ $message->embed(public_path().'/images/reservations/envelope.png') }}"></div>
                                <div style="vertical-align: middle; display: table-cell">justyna.mroczek@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <br><br><br>

    </div>

</div>
<hr style="border: 0 none;  border-top: 2px dashed black;  background: none;">
<table style="margin-left: auto; margin-right: auto;">
    <tr><td style="font-size: 11px">Kontakt: 22/565 66 66 (pn-pt 9:00-17:00), <span style="color: #8fdf82">kontakt@visitzakopane.pl</span></td></tr>
</table>
<hr style="border: 0 none;  border-top: 2px dashed black;  background: none;">
<span style="font-size: 11px; color: gray">Ta wiadomość została wysłana przez Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</span>
</body>
</html>