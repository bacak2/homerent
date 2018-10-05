@extends ('layout.layout')
@section('title', __('messages.Article'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 col-md-3 col-lg-2 mb-2">
            <a href="{{ route('aboutUs.news') }}" class="pointer-back" style="background-image: url('{{ asset("images/news/otherNews.png") }}')">
                <div  class="btn font-13" style="width: 100%" >
                    {{__('messages.Other articles')}}
                </div>
            </a>
        </div>
        <div class="col-12 col-md-9 col-lg-10 mb-2">
            <span class="pull-right">
                <div class="d-inline-block">
                    <div class="d-inline-block send-news-friends mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                        <img style="padding: 7px 9px; max-width: 36px" src="{{asset('images/favourites/Envelop.png')}}">
                    </div>
                    <div class="d-inline-block send-news-friends font-13 txt-blue" style="margin-top: 6px;">{{__('messages.Send to friend')}}</div>
                </div>
                <div class="d-inline-block">|</div>
                <div class="d-inline-block">
                    <div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                        <img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/favourites/Pdf_file.png')}}">
                    </div>
                    <a href="{{route('aboutUs.printPdf', $news->news_id)}}" class="d-inline-block font-13 txt-blue" style="margin-top: 6px;">{{__('messages.Save')}}</a>
                </div>
            </span>
        </div>
    </div>
    <h1 style="font-size: 32px; font-weight: bold;">{{ $news->news_title }}</h1>
    <div class="row">
        <div class="col-12">
            <div style="border-bottom: 2px solid black">
                <p>{!! $news->news_content !!}</p>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="d-inline-block">
                <div class="d-inline-block send-news-friends mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                    <img style="padding: 7px 9px; max-width: 36px" src="{{asset('images/favourites/Envelop.png')}}">
                </div>
                <div class="d-inline-block send-news-friends font-13 txt-blue" style="margin-top: 6px;">{{__('messages.Send to friend')}}</div>
            </div>
            <div class="d-inline-block">|</div>
            <div class="d-inline-block">
                <div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                    <img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/favourites/Pdf_file.png')}}">
                </div>
                <a href="{{route('aboutUs.printPdf', $news->news_id)}}" class="d-inline-block font-13 txt-blue" style="margin-top: 6px;">{{__('messages.Save')}}</a>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-12 mb-1" style="color: #0066CC; font-size: 24px; font-weight: bold">
            <a href="{{route('aboutUs.news')}}">{{__('messages.Other articles')}}</a>
        </div>
        @foreach($otherNews as $otherNewsEntity)
        <div class="col-6 col-md-3 mb-3 mb-md-0">
            <div style="background-color: #E4E4E4">
                <img style="width: 100%; height: auto" src="{{asset('images/media').'/'.$otherNewsEntity->news_min_img}}">
                <div class="pl-2 pt-1 pb-2">
                    <a href="{{route('aboutUs.newsDetail', $otherNewsEntity->news_id)}}">{{$otherNewsEntity->news_title}}</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12 mt-2" style="color: #0066CC; font-size: 16px; font-weight: bold">
            <a class="pull-right" href="{{route('aboutUs.news')}}">{{__('messages.See all')}} »</a>
        </div>
    </div>
</div>

<div id="send-news">
    <span style="font-size: 24px; font-weight: bold">{{__('messages.Send to friend')}}</span><br>
    <div class="row">
        <div class="col-2"><span class="font-14">Link:</span></div>
        <div class="col-10">
            <ul class="font-13">
                <li>
                    <span id="link">{{Request::url()}}</span>
                    <span class="txt-blue copy-to-clipboard" onclick="copyToClipboard('#link')">{{__('messages.Copy')}}</span>
                </li>
            </ul>
        </div>
    </div>

    <label for="emails2">{{__('messages.Email addresses')}}:</label>
    <input id="emails2" name="emails2" type="text" placeholder="{{__('messages.Emails ph')}}">
    <input id="links" name="links" type="hidden" value="{{Request::url()}}">
    <hr>
    <div style="text-align: center;">
        <button id="send-mail-with-news" class="btn btn-primary">{{__('messages.Send')}}</button>
        <button class="btn btn-default close-send-news-friends">{{__('messages.Cancel')}}</button>
    </div>
    <div id="close-send-news" class="close-send-news-friends">x</div>
</div>

<div id="confirm-send-news-friends" class="text-center">
    <br><span style="font-size: 24px; font-weight: bold">{{__('messages.Email has been sended')}}</span><br><br><br>
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
                link: $("#link").text(),
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