@extends ('layout.layout')

@section('title', __('messages.My account') )

@section('content')

<div class="container">

    <div class="row"><h1 style="font-size: 32px; font-weight: bold">Dziękujemy za wysłanie recenzji</h1></div>
    <div class="row font-16" style="margin-top: 14px">Przekazując informacje na temat pobytu w tym obiekcie pomagasz innym podróżnym podejmować lepsze decyzje.</div>
    <div class="row"><a id="btn-back-from-comment" class="btn btn-default" href="/">« Powrót do strony głównej</a></div>
    <div class="row" style="margin-top: 50px;"><span style="font-size: 24px; font-weight: bold">Twoja recenzja</span></div>
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-3" style="margin-top: 24px; padding-left:0px">
            @if($opinionData['user_name'] == NULL && $opinionData['user_country'] == NULL && $opinionData['user_city'] == NULL) Anonimowy
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
                    <div class="row font-11" style="margin-top: 7px;">Opinia z: {{date("d.m.Y", strtotime($opinionData['created_at']))}}</div>
                </div>
            @endif

        </div>
        <div class="comment-background col-9 row py-3" style="background-image: url('{{ asset("images/opinions/comment_background.png") }}')">
            <div class="col-1" style="padding-left: 0px;">
                <div style="font-size: 22px" class="overall-rating-box center-h-v @if($opinionData['total_rating'] > 0 && $opinionData['total_rating'] <= 3) rating-red @elseif($opinionData['total_rating'] > 3 && $opinionData['total_rating'] <= 6) rating-yellow @else rating-green @endif"><b>{{$opinionData['total_rating']}}</b></div>
            </div>
            <div class="col-11 comment-row mb-3" style="padding-right: 0px; padding-left: 0px;">
                <div class="col-12 mb-2" style="padding-right: 0px; margin-left: 34px">
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
                            <div class="ml-2">
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
                            <div class="ml-2">
                                {{$opinionData['cons']}}
                            </div>
                        </div>
                    </div>
                @endif
                <b class="font-11" style="margin-left: 34px">Pobyt: {{strftime("%B %Y", strtotime($visitDate->reservation_arrive_date))}}</b>
            </div>
            <div class="col-12 pt-5 pb-4 font-12" style="border-top: gray solid 1px">
                <div class="row mb-1">
                    <div class="col-4">
                        Czystość
                        <span class="pull-right px-1 ml-2 @if($opinionData['cleanliness'] > 0 && $opinionData['cleanliness'] <= 3) rating-red @elseif($opinionData['cleanliness'] > 3 && $opinionData['cleanliness'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['cleanliness']}}</span>
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
                    <div class="col-4">
                        Udogodnienia
                        <span class="pull-right px-1 ml-2 @if($opinionData['facilities'] > 0 && $opinionData['facilities'] <= 3) rating-red @elseif($opinionData['facilities'] > 3 && $opinionData['facilities'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['facilities']}}</span>
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
                    <div class="col-4">
                        <div class="price-per-quality">Stosunek jakości do ceny</div>
                        <span style="position: absolute;top: 0px;right: 0px;">
                            <span class="pull-right px-1 ml-2 @if($opinionData['quality_per_price'] > 0 && $opinionData['quality_per_price'] <= 3) rating-red @elseif($opinionData['quality_per_price'] > 3 && $opinionData['quality_per_price'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['quality_per_price']}}</span>
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
                <div class="row">
                    <div class="col-4">
                        Lokalizacja
                        <span class="pull-right px-1 ml-2 @if($opinionData['location'] > 0 && $opinionData['location'] <= 3) rating-red @elseif($opinionData['location'] > 3 && $opinionData['location'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['location']}}</span>
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
                    <div class="col-4">
                        Obsługa
                        <span class="pull-right px-1 ml-2 @if($opinionData['staff'] > 0 && $opinionData['staff'] <= 3) rating-red @elseif($opinionData['staff'] > 3 && $opinionData['staff'] <= 6) rating-yellow @else rating-green @endif">{{$opinionData['staff']}}</span>
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
    {{--dd($opinionData)--}}
</div>

@endsection