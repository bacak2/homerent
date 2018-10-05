<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-size: 12px; font-family: 'Open Sans', sans-serif;">
<div>
    <table>
        <tr><td>{{__('messages.Welcome')}},</td></tr>
        <tr><td>{{__('messages.MailContent3')}}</td></tr>
        <tr><td><br><br><a href="{{$link}}" target="_blank">{{$link}}</a><br></td></tr>
        <tr><td><br><br><br><br></td></tr>
        <tr><td><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td style="font-size: 11px">{{__('messages.Contact')}}: {{getContactPhone()}} ({{__('messages.monToFri')}} 9:00-17:00), <span style="color: #8fdf82">{{getContactEmail()}}</span></td></tr>
        <tr><td><hr style="border: 0 none;  border-top: 2px dashed black;  background: none;"></td></tr>
        <tr><td><span style="font-size: 11px; color: gray">{{__('messages.Mail footer')}}</span></td></tr>
    </table>
</div>
</body>
</html>