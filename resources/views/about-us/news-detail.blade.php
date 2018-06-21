@extends ('layout.layout')
@section('title', 'Artykuł detal')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 col-md-2 mb-2">
            <a href="{{ route('aboutUs.news') }}" class="pointer-back" style="background-image: url('{{ asset("images/news/otherNews.png") }}')">
                <div  class="btn font-13" style="width: 100%" >
                    <b>Inne artykuły</b>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-10 mb-2">
            <div class="pull-right send-news-friends">Wyślij znajomemu</div>
        </div>
    </div>
    <h1 style="font-size: 32px; font-weight: bold;">Tytuł artykułu lorem ipsum</h1>
    <div class="row">
        <div class="col-12">
            <div style="border-bottom: 2px solid black">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
            </div>
        </div>
        <div class="col-12">
            <div class="send-news-friends">Wyślij znajomemu</div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-12 mb-1" style="color: #0066CC; font-size: 24px; font-weight: bold">
            <a href="{{route('aboutUs.news')}}">Inne artykuły</a>
        </div>
        @for($i=0; $i<4; $i++)
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div style="background-color: #E4E4E4">
                <img style="width: 100%; height: auto" src="{{asset('images/news/newsIcon.png')}}">
                <div class="pl-2 pt-1 pb-2">
                    <a href="{{route('aboutUs.newsDetail', $i)}}">Tytuł artykułu lorem ipsum</a>
                </div>
            </div>
        </div>
        @endfor
        <div class="col-12 mt-2" style="color: #0066CC; font-size: 16px; font-weight: bold">
            <a class="pull-right" href="{{route('aboutUs.news')}}">Zobacz wszystko »</a>
        </div>
    </div>
</div>

<div id="send-news">
    <span style="font-size: 24px; font-weight: bold">Wyślij znajomemu</span><br>
    <div class="row">
        <div class="col-2"><span class="font-14">Link:</span></div>
        <div class="col-10">
            <ul class="font-13">
                <li>
                    <span id="link">{{Request::url()}}</span>
                    <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard('#link')">Skopiuj</span>
                </li>
            </ul>
        </div>
    </div>

    <label for="emails2">Adresy e-mail:</label>
    <input id="emails2" name="emails2" type="text" placeholder="Wpisz adresy e-mail (rozdziel je przecinkami)">
    <input id="links" name="links" type="hidden" value="{{Request::url()}}">
    <hr>
    <button id="send-mail-with-news" class="btn btn-default">Wyślij</button>
    <button class="btn btn-default close-send-news-friends">Anuluj</button>

    <div id="close-send-news" class="close-send-news-friends">x</div>
</div>

<div id="confirm-send-news-friends">
    <span style="font-size: 24px; font-weight: bold">Wiadomość e-mail została wysłana</span><br>
    <button class="btn btn-default close-confirm-news">OK</button>
</div>

<script>
    $(".send-news-friends").click(function() {
        $("#send-news").show();
        $("#send-to").hide();
        if($("#truncate-favourites").css("display") != "none") $("#truncate-favourites").hide();
    });

    $(".close-send-news-friends").click(function() {
        $("#send-news").hide();
    });

    $(".close-confirm-news").click(function() {
        $("#confirm-send-news-friends").hide();
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    $("#send-mail-with-news").on('click', function(){
        sendMailWithNews();
    });

    function sendMailWithNews(){

        mailWithNewsSended();

        $.ajax({
            type: "GET",
            url: '/send-news-to-friends',
            dataType : 'json',
            data: {
                emails2: $("#emails2").val(),
                link: $("#link").val(),
            },
            success: function() {
                //
            },
            error: function(data) {
                console.log(data);
            },
        });
    }

    function mailWithNewsSended(){
        $('#send-news').hide();
        $('#confirm-send-news-friends').show();
    }
</script>
@endsection