<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-size: 12px; font-family: 'Open Sans', sans-serif;">
<div>
<table>
    <tr><td colspan="2">Wiadomość z formularza kontaktowego</td></tr>
    @if(isset($request->contactEmail))<tr><td>Adres e-mail: </td><td>{{$request->contactEmail}}</td></tr>@endif
    @if(isset($request->contactPhone))<tr><td>Telefon: </td><td>{{$request->contactPhone}}</td></tr>@endif
    @if(isset($request->reason))
        <tr>
            <td>Dotyczy: </td>
            <td>
            @switch($request->reason)
                @case(0) Podróżującego @break
                @case(1) Właściciela obiektu @break
                @case(3) Opinii @break
                @case(2) @default Inny @break
            @endswitch
            </td>
        </tr>
    @endif
    @if(isset($request->contactMessage))<tr><td>Treść wiadomości: </td><td>{{$request->contactMessage}}</td></tr>@endif
</table>
</div>
</body>
</html>