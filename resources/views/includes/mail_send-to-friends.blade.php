<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-size: 12px; font-family: 'Open Sans', sans-serif;">
<div>
    <table>
        @foreach ($test as $link)
            <a href="{{$link}}" target="_blank">{{$link}}</a><br>
        @endforeach
        <tr><td><br><br><br><br></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td></td><td colspan="2" style="font-size: 11px">Kontakt: 22/565 66 66 (pn-pt 9:00-17:00), <span style="color: #8fdf82">kontakt@visitzakopane.pl</span></td></tr>
        <tr><td colspan="3"><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td colspan="3"><span style="font-size: 11px; color: gray">Ta wiadomość została wysłana przez Homerent.</span></td></tr>
    </table>
</div>
</body>
</html>