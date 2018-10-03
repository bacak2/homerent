@extends ('layout.layout')

@section('title', __('messages.My account') )

@section('content')

<div class="container">

    <div><h1 style="font-size: 32px; font-weight: bold">{{__('messages.Thank you for sending a review')}}</h1></div>
    <div class="font-16" style="margin-top: 14px">{{__('messages.WriteReview2')}}</div>
    <div class="mt-2"><a id="btn-back-from-comment" class="btn" href="/">« {{__('messages.Back to main page')}}</a></div>
    <div class="mt-2 mt-lg-5"><span style="font-size: 24px; font-weight: bold">{{__('messages.Your review')}}</span></div>
    <div class="row mx-0" style="margin-bottom: 50px;">
        <div class="col-md-3" style="margin-top: 24px; padding-left:0px">
            @if($opinionData['user_name'] == NULL && $opinionData['user_country'] == NULL && $opinionData['user_city'] == NULL) {{__('messages.Anonymous')}}
            @else
                <div style="float: left">
                    <div style="width: 50px">
                        <img src='{{ asset("images/opinions/journey-type-".$opinionData["journey_type"].".png") }}'>
                        <span class="font-11 under-journey-type">{{$journey_type}}</span>
                    </div>
                </div>
                <div class="col-12" style="margin-left: 56px">
                    <div class="row"><b>{{$opinionData['user_name']}}</b></div>
                    <div class="row">{{$opinionData['user_country']}}, {{$opinionData['user_city']}}</div>
                    <div class="row font-11" style="margin-top: 7px;">{{__('messages.Opinion from')}}: {{date("d.m.Y", strtotime($opinionData['created_at']))}}</div>
                </div>
            @endif

        </div>
        <div id="opinion-added-comment" class="comment-background col-md-9 row py-3 pt-5 pt-md-3" @mobile style="background-image: url('{{ asset("images/opinions/comment_background_mobile.png") }}')" @elsemobile style="background-image: url('{{ asset("images/opinions/comment_background.png") }}')" @endmobile>
            <div class="col-2 col-lg-1 px-0">
                <div style="font-size: 22px" class="overall-rating-box center-h-v @if($opinionData['total_rating'] > 0 && $opinionData['total_rating'] <= 3) rating-red @elseif($opinionData['total_rating'] > 3 && $opinionData['total_rating'] <= 6) rating-yellow @else rating-green @endif"><b>{{$opinionData['total_rating']}}</b></div>
            </div>
            <div class="col-10 col-lg-11 mx-0 comment-row mb-3 px-md-0">
                <div class="col-12 mb-2" style="padding-right: 0px;">
                    @for ($i = 0; $i < floor($opinionData['total_rating']/2); $i++)
                        <img src='{{ asset("images/opinions/star.png") }}'>
                    @endfor
                    @if(floor($opinionData['total_rating']/2) != ceil($opinionData['total_rating']/2))
                        <img src='{{ asset("images/opinions/star_half.png") }}'>
                    @endif
                    @for ($i = ceil($opinionData['total_rating']/2); $i < 5; $i++)
                        <img src='{{ asset("images/opinions/star_empty.png") }}'>
                    @endfor
                </div>
                @if($opinionData['pros'] != NULL)
                    <div class="col-12 row font-12 mb-3 ml-1" style="padding-right: 0px">
                        <div class="col-1 center-h-v">
                            <div style="background-color: #4eff5e; color: white; width:16px; height: 16px"><b>+</b></div>
                        </div>
                        <div class="col-11 comment-row" style="margin-left: -40px; padding-right: 0px">
                            <div class="ml-5 ml-md-4 ml-lg-3 ml-xl-1">
                                {{$opinionData['pros']}}
                            </div>
                        </div>
                    </div>
                @endif
                @if($opinionData['cons'] != NULL)
                    <div class="col-12 row font-12 mb-3 ml-1" style="padding-right: 0px">
                        <div class="col-1 center-h-v">
                            <div style="background-color: #ff2620; color: white; width:16px; height: 16px"><b>-</b></div>
                        </div>
                        <div class="col-11 comment-row" style="margin-left: -40px; padding-right: 0px">
                            <div class="ml-5 ml-md-4 ml-lg-3 ml-xl-1">
                                {{$opinionData['cons']}}
                            </div>
                        </div>
                    </div>
                @endif
                <b class="font-11">{{__('messages.Stay')}}: {{strftime("%B %Y", strtotime($visitDate->reservation_arrive_date))}}</b>
            </div>
            <div class="col-12 pt-5 pb-4 font-12 px-0" style="border-top: gray solid 1px">
                <div class="row mx-0 mb-1">
                    <div class="col-md-6 col-lg-4 pl-0 pr-0 pr-md-3 mb-2 mb-md-0">
                        {{__('messages.Czystość')}}
                        <span class="pull-right px-1 ml-1 @if($opinionData['cleanliness'] > 0 && $opinionData['cleanliness'] <= 3) rating-red @elseif($opinionData['cleanliness'] > 3 && $opinionData['cleanliness'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['cleanliness']}}</span>
                        <span class="pull-right" style="background-color: #fff">
                            @for ($i = 0; $i < floor($opinionData['cleanliness']/2); $i++)
                                <img src='{{ asset("images/opinions/dot.png") }}'>
                            @endfor
                            @if(floor($opinionData['cleanliness']/2) != ceil($opinionData['cleanliness']/2))
                                <img src='{{ asset("images/opinions/dot_half.png") }}'>
                            @endif
                            @for ($i = ceil($opinionData['cleanliness']/2); $i < 5; $i++)
                                <img src='{{ asset("images/opinions/dot_empty.png") }}'>
                            @endfor
                        </span>
                    </div>
                    <div class="col-md-6 col-lg-4 pl-0 pr-0 pr-md-3 mb-2 mb-md-0">
                        {{__('messages.Udogodnienia')}}
                        <span class="pull-right px-1 ml-1 @if($opinionData['facilities'] > 0 && $opinionData['facilities'] <= 3) rating-red @elseif($opinionData['facilities'] > 3 && $opinionData['facilities'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['facilities']}}</span>
                        <span class="pull-right" style="background-color: #fff">
                            @for ($i = 0; $i < floor($opinionData['facilities']/2); $i++)
                                <img src='{{ asset("images/opinions/dot.png") }}'>
                            @endfor
                            @if(floor($opinionData['facilities']/2) != ceil($opinionData['facilities']/2))
                                <img src='{{ asset("images/opinions/dot_half.png") }}'>
                            @endif
                            @for ($i = ceil($opinionData['facilities']/2); $i < 5; $i++)
                                <img src='{{ asset("images/opinions/dot_empty.png") }}'>
                            @endfor
                        </span>
                    </div>
                    <div class="col-md-6 col-lg-4 pl-0 mt-md-2 mt-lg-0 pr-0 pr-md-3 mb-2 mb-md-0">
                        <div class="price-per-quality">{{__('messages.Value to')}}<br>{{__('messages.price ratio')}}</div>
                        <span id="price-per-quality-bar" style="position: absolute;top: 0px;right: 0px;">
                            <span class="pull-right px-1 ml-1 @if($opinionData['quality_per_price'] > 0 && $opinionData['quality_per_price'] <= 3) rating-red @elseif($opinionData['quality_per_price'] > 3 && $opinionData['quality_per_price'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['quality_per_price']}}</span>
                            <span class="pull-right" style="background-color: #fff">
                                @for ($i = 0; $i < floor($opinionData['quality_per_price']/2); $i++)
                                    <img src='{{ asset("images/opinions/dot.png") }}'>
                                @endfor
                                @if(floor($opinionData['quality_per_price']/2) != ceil($opinionData['quality_per_price']/2))
                                    <img src='{{ asset("images/opinions/dot_half.png") }}'>
                                @endif
                                @for ($i = ceil($opinionData['quality_per_price']/2); $i < 5; $i++)
                                    <img src='{{ asset("images/opinions/dot_empty.png") }}'>
                                @endfor
                            </span>
                        </span>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-md-6 col-lg-4 pl-0 pr-0 pr-md-3 mb-2 mb-md-0">
                        {{__('messages.Lokalizacja')}}
                        <span class="pull-right px-1 ml-1 @if($opinionData['location'] > 0 && $opinionData['location'] <= 3) rating-red @elseif($opinionData['location'] > 3 && $opinionData['location'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['location']}}</span>
                        <span class="pull-right" style="background-color: #fff">
                            @for ($i = 0; $i < floor($opinionData['location']/2); $i++)
                                <img src='{{ asset("images/opinions/dot.png") }}'>
                            @endfor
                            @if(floor($opinionData['location']/2) != ceil($opinionData['location']/2))
                                <img src='{{ asset("images/opinions/dot_half.png") }}'>
                            @endif
                            @for ($i = ceil($opinionData['location']/2); $i < 5; $i++)
                                <img src='{{ asset("images/opinions/dot_empty.png") }}'>
                            @endfor
                        </span>
                    </div>
                    <div class="col-md-6 col-lg-4 pl-0 pr-0 pr-md-3 mb-2 mb-md-0">
                        {{__('messages.Obsługa')}}
                        <span class="pull-right px-1 ml-1 @if($opinionData['staff'] > 0 && $opinionData['staff'] <= 3) rating-red @elseif($opinionData['staff'] > 3 && $opinionData['staff'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['staff']}}</span>
                        <span class="pull-right" style="background-color: #fff">
                            @for ($i = 0; $i < floor($opinionData['staff']/2); $i++)
                                <img src='{{ asset("images/opinions/dot.png") }}'>
                            @endfor
                            @if(floor($opinionData['staff']/2) != ceil($opinionData['staff']/2))
                                <img src='{{ asset("images/opinions/dot_half.png") }}'>
                            @endif
                            @for ($i = ceil($opinionData['staff']/2); $i < 5; $i++)
                                <img src='{{ asset("images/opinions/dot_empty.png") }}'>
                            @endfor
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(window).resize(function() {
        setBackgroundImg();
    });

    $(document).ready(function() {
        setBackgroundImg();
    });

    function setBackgroundImg(){
        windowWidth = $(window).width();
        if(windowWidth > 767) $("#opinion-added-comment").css("background-image", "url('{{ asset("images/opinions/comment_background.png") }}')");
        else $("#opinion-added-comment").css("background-image", "url('{{ asset("images/opinions/comment_background_mobile.png") }}')");
    }
</script>

@endsection