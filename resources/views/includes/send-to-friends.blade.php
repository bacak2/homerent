<div id="send-to">
    <span style="font-size: 24px; font-weight: bold">{{__('messages.Send to friend')}}</span><br>
    <div class="row">
        <div class="col-2"><span class="font-14">{{__('messages.Links')}}:</span></div>
        <div class="col-10">
            <ul class="font-13">
                @if(Session::get('userFavouritesAll') !== null) {{-- && !Session::get('userFavouritesAll')->isEmpty()) --}}
                    @foreach(Session::get('userFavouritesAll') as $apartament)
                        <li>
                            <span id="link{{ $apartament->id }}">{{route('apartamentInfo', $apartament->apartament_link)}}</span>
                            <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard('#link{{ $apartament->id }}')">{{__('messages.Copy')}}</span>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <label for="emails">{{__('messages.Email addresses')}}:</label>
    <input id="emails" name="emails" type="text" placeholder="{{__('messages.Emails ph')}}">
    <input id="links" name="links" type="hidden" value="@if(Session::get('userFavouritesAll') !== null) @foreach(Session::get('userFavouritesAll') as $apartament){{route('apartamentInfo', $apartament->apartament_link)}},@endforeach @endif">
    <hr>
    <div style="text-align: center;">
        <button id="send-mail-to-friends" class="btn btn-primary">{{__('messages.Send')}}</button>
        <button class="btn btn-default close-send-to">{{__('messages.Cancel')}}</button>
    </div>


    <div id="close-send-to" class="close-send-to">x</div>
</div>

<div id="confirm-sended-to-friends" class="text-center">
    <br><span style="font-size: 24px; font-weight: bold">{{__('messages.Email has been sended')}}</span><br>
    <div style="text-align: center">
        <button class="btn btn-default close-confirm-sended">OK</button>
    </div>
</div>

<script>
    $(".send-to-friends").click(function() {
        $("#send-to").show();
        if($("#truncate-favourites").css("display") != "none") $("#truncate-favourites").hide();
    });

    $(".close-send-to").click(function() {
        $("#send-to").hide();
    });

    $(".close-confirm-sended").click(function() {
        $("#confirm-sended-to-friends").hide();
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    $("#send-mail-to-friends").on('click', function(){
        sendMailToFriends();
    });

    function sendMailToFriends(){

        mailToFriendsSended();

        $.ajax({
            type: "GET",
            url: '/account/send-email-to-friends',
            dataType : 'json',
            data: {
                emails: $("#emails").val(),
                links: $("#links").val(),
            },
            success: function() {
                //
            },
            error: function(data) {
                console.log(data);
            },
        });
    }

    function mailToFriendsSended(){
        $('#send-to').hide();
        $('#confirm-sended-to-friends').show();
    }
</script>