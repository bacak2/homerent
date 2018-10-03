@extends ('layout.layout')
@section('title', $guidebook->guidebook_title)

@section('content')
<div class="container">
    <div class="row mb-1">
        <div class="col-12 font-13">
            <a href="/">Start ></a> <a href="{{route('guidebooks.Index')}}">{{__('messages.Guidebooks')}} ></a> <span class="bold">{{$guidebook->guidebook_title}}</span>
            <span class="pull-right">
                <div class="d-inline-block">
                    <div class="d-inline-block send-news-friends mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                        <img style="padding: 7px 9px; max-width: 36px" src="{{asset('images/favourites/Envelop.png')}}">
                    </div>
                    <div class="d-inline-block send-news-friends font-13 txt-blue" style="margin-top: 6px;"> {{__('messages.Send to friend')}}</div>
                </div>
                <div class="d-inline-block">|</div>
                <div class="d-inline-block">
                    <div class="d-inline-block mr-1" style="width: 38px; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(153, 153, 153, 1); border-radius: 4px">
                        <img style="padding: 5px 7px; max-width: 36px" src="{{asset('images/favourites/Pdf_file.png')}}">
                    </div>
                    <a href="{{route('guidebooks.printPdf', $guidebook->guidebook_link)}}" class="d-inline-block font-13 txt-blue" style="margin-top: 6px;">{{__('messages.Save')}}</a>
                </div>
            </span>
        </div>
    </div>

    <div class="img-container" style="position: relative;">
        <img class="img-fluid" src='{{ asset("images/guidebooks/detail_$guidebook->guidebook_img") }}'>
        <span style="position: absolute; left: 30px; bottom: 30px; background-color: rgba(255,255,255,0.69); padding: 8px 10px;">
            <h1 class="h1-owners">{{$guidebook->guidebook_title}}</h1>
        </span>
        <div class="p-3 center-h-v d-none d-sm-block" style="position: absolute; min-width: 120px; right: 10px; top: 10px; background-color: rgba(255,255,255,0.69)">
            <div class="font-11 mb-1">{{$guidebook->guidebook_city}}</div>
            <div><img src="{{$icon}}"></div>
            <div class="bold" style="font-size: 20px">{{$temperature}}</div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12 font-18">
            <p>{{$guidebook->guidebook_header}}</p>
        </div>
    </div>

    @if(!$tags->isEmpty())
        <div class="row mt-2 mb-4">
            <div class="col-12 font-16">{{__('messages.Categories')}}:</div>
            <div class="col-12 font-13">
                @foreach($tags as $tag)
                    <div class="d-inline-block p-1 mr-1" style="color: #0099FF; background-color: rgba(242, 242, 242, 1); border: 1px solid rgba(204, 204, 204, 1);"><a href="{{route('guidebooks.Tag', $tag->tag_link)}}">{{$tag->tag_name}}</a></div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row mt-2 mb-5">
        <div class="col-12 font-13">
            <div class="font-16 pb-3" style="border-bottom: 2px solid black">
                {!! $guidebook->guidebook_content !!}
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
                <a href="{{route('guidebooks.printPdf', $guidebook->guidebook_link)}}"class="d-inline-block font-13 txt-blue" style="margin-top: 6px;">{{__('messages.Save')}}</a>
            </div>
        </div>
    </div>

    @if(!$apartmentsNearby->isEmpty())
    <h2 class="bold txt-blue" style="font-size: 24px">{{__('messages.Apartments in this area')}}</h2>

    @include('includes.apartments-nearby')

    @endif

    @if(!$relatedGuidebooks->isEmpty())
        <h2 class="bold" style="font-size: 24px">{{__('messages.Related guidebooks')}}</h2>
        <div class="row">
            @foreach($relatedGuidebooks as $guidebook)
                <div class="col-12 col-md-4 mb-3">
                    <div style="position: relative">
                        <a class="to-download-description" href="{{route('guidebooks.Detail', $guidebook->guidebook_link)}}">
                            <img class="img-fluid" src="{{asset("images/guidebooks/$guidebook->guidebook_img")}}">
                        </a>
                        <div class="guidebooks-top-description">{{$guidebook->guidebook_title}}</div>
                        <div class="guidebooks-bottom-description">{{__('messages.Guidebook')}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

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
            url: '/send-guidebook-to-friends',
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