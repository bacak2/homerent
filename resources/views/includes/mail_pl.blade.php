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
        <tr><td style="font-size: 16px;">{{__('messages.Welcome')}},</td></tr>
        <tr><td><br></td></tr>
        <tr><td colspan="3" style="font-size: 16px;">{{__('messages.Thx')}}</td></tr>
        <tr><td><br></td></tr>
        <tr><td colspan="2"></td></tr>
        <tr>
            <td><img style="width: 160px; height: 88px" src="{{ $message->embed(public_path().'/images/apartaments/'.$apartament_id.'/mail.jpg') }}"></td>
            <td colspan="2">
                <span style="color: #007bff; font-size: 20px;"><b>{{$apartament_name}}</b></span><br>
                <span style="font-size: 15px">{{$apartament_city}}, {{$apartament_district}}</span><br>
                <span style="font-size: 15px">{{$apartament_address}}</span><br>
            </td>
        </tr>
        <tr><td colspan="2"><span style="font-size: 12px">{{$apartament_gps}}</span></td></tr>
        <tr><td colspan="3"><hr></td></tr>
        <tr style="font-size: 15px">
            <td></td><td>{{__('messages.arrive')}}:</td><td><b>{{strtolower(strftime("%a, %d %b %Y", strtotime($reservation_arrive_date)))}}</b> ({{__('messages.after')}} {{$reservation_arrive_time}})</td>
        </tr>
        <tr style="font-size: 15px">
            <td></td><td>{{__('messages.departure')}}:</td><td><b>{{strtolower(strftime("%a, %d %b %Y", strtotime($reservation_departure_date)))}}</b> ({{$apartament_checkout_time}})</td>
        </tr>
        <tr style="font-size: 14px">
            <td></td><td>{{__('messages.nights2')}}:</td><td>{{$reservation_nights}}</td>
        </tr>
        <tr style="font-size: 14px">
            <td></td><td>{{__('messages.Persons')}}:</td><td>{{$reservation_persons}} {{trans_choice('messages.adult persons', $reservation_persons)}}, {{$reservation_kids}} {{__('messages.Kids')}}</td>
        </tr>
        <tr><td><br></td></tr>
        @if($reservation_status == 0)
            <tr style="font-size: 15px">
                <td></td><td><b>{{__('messages.To pay')}}: </b></td><td><b>{{$payment_to_pay}} PLN*</b></td>
            </tr>
        @elseif($payment_to_pay > 0)
            <tr style="font-size: 15px">
                <td></td><td><b>{{__('messages.To pay')}}: </b></td><td><b>{{$payment_to_pay}} PLN*</b></td>
            </tr>
        @else
            <tr style="font-size: 15px">
                <td></td><td><b>{{__('messages.Paid')}}: </b></td><td><b>{{$payment_full_amount}} PLN*</b> ({{date("d.m.Y", strtotime($updated_at))}})</td>
            </tr>
        @endif
        <tr><td><br></td></tr>
        <tr>
            <td></td><td></td>
        </tr>
        <tr style="font-size: 14px">
            <td></td><td>{{__('messages.Cost of stay')}}:</td><td> {{$payment_full_amount}} PLN</td>
        </tr>
        @if($payment_to_pay > 0)
        <tr style="font-size: 14px">
            <td></td><td>{{__('messages.Advance')}}: </td><td>{{$payment_full_amount - $payment_to_pay}} PLN* ({{__('messages.Paid')}}, {{date("d.m.Y", strtotime($updated_at))}})</td>
        </tr>
        @endif
        <tr><td><br></td></tr>
        <tr>
            <td></td>
            <td colspan="2" style="font-size: 11px">
                * {{__('messages.AdditionalCostExp4')}} -<br>
                {{__('messages.AdditionalCostExp5')}}
            </td>
        </tr>
        <tr><td><br><br><br><br></td></tr>
        <tr>
            <td style="font-size: 12px;">{{__('messages.Contact')}}:<br>{{getContactPerson()}}</td>
            <td colspan="2">
                <div style="position: relative; display: inline-block; border: solid #838383 2px; border-radius: 5px; background-color: #e2e2e2; padding: 0px 5px">
                    <img  src="{{ $message->embed(public_path().'/images/reservations/phone.png') }}">
                    <span style="position: relative; left: 0; top: -12px; font-size: 11px">{{getContactPhone()}}</span>
                </div>
                <div style="position: relative; display: inline-block; border: solid #838383 2px; border-radius: 5px; background-color: #e2e2e2; padding: 0px 5px">
                    <img  src="{{ $message->embed(public_path().'/images/reservations/phone.png') }}">
                    <span style="position: relative; left: 0; top: -12px; font-size: 11px">{{getContactSecondPhone()}}</span>
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div style="position: relative; display: inline-block; border: solid #838383 2px; border-radius: 5px; background-color: #e2e2e2; padding: 0px 5px">
                    <img  src="{{ $message->embed(public_path().'/images/reservations/envelope.png') }}">
                    <span style="position: relative; left: 0; top: -12px; font-size: 11px">{{getContactEmail()}}</span>
                </div>
            </td>
        </tr>
        <tr><td><br><br><br><br></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td></td><td colspan="2" style="font-size: 11px">{{__('messages.Contact')}}: {{getContactPhone()}} ({{__('messages.monToFri')}} 9:00-17:00), <span style="color: #8fdf82">{{getContactEmail()}}</span></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td colspan="3"><span style="font-size: 11px; color: gray">{{__('messages.Mail footer')}}</span></td></tr>
    </table>

</div>
</body>
</html>