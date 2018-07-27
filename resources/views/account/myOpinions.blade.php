@extends ('layout.layout')

@section('title', __('messages.my opinions') )

@section('content')
<div class="container">
@if($users_opinions->isEmpty())
    <div class="row mt-4 mb-2">
        <div class="col-lg-3 col-12"><h1 style="font-size: 28px"><b>Opinie</b></h1></div>
    </div>
    <div class="row mt-4 mb-2">
        <div class="col-12">Nie możesz jeszcze dodawać opinii.</div>
    </div>
@else
    <div class="row mt-4 mb-2">
        <div class="col-12 pl-md-0 pl-lg-3">
            <span style="font-size: 28px"><b>Moje opinie</b></span>
            @if($opinionToAdd > 0)
                <div class="btn-group user-opinion mr-3">
                    <a class="btn @if($buttonCheck == 1) btn-selected @endif btn-info btn-mobile" href="{{route('myOpinions')}}">{{__('Wszystkie')}}</a>
                    <a class="btn @if($buttonCheck == 2) btn-selected @endif btn-info btn-mobile" href="{{route('myOpinionsToAdd')}}">{{__('Do wystawienia')}}<div class="red-nr-alert">{{$opinionToAdd}}</div></a>
                </div>
            @endif
        </div>
    </div>

    {{--table header--}}
        <div class="row d-none d-lg-flex" style="font-size: 20px"><div class="col-lg-6"></div><div class="col-lg-2 px-lg-2" style="margin-left: -15px;"><b>Średnia ocen</b></div><div class="col-lg-4 px-lg-0"><b>Twoja ocena</b></div></div>
    {{--end header--}}
    @foreach($users_opinions as $opinion)
        <div class="user-opinion-row row py-3 my-3 my-md-0 mr-md-0">
            <div class="col-lg-2 col-4 pl-md-0 pl-lg-3"><img src='{{ asset("images/apartaments/$opinion->apartament_id/1.jpg") }}') style="width: 100%;"></div>
            <div class="col-lg-3 col-8 pl-3 pl-md-0 pl-lg-3">
                <span class="font-16 txt-blue" style="font-weight: bold"><a href="/apartaments/{{ $opinion->apartament_link }}">{{ $opinion->apartament_name }}</a></span><br>
                <span class="font-12">
                    {{ $opinion->apartament_city }} ({{ $opinion->apartament_district }})<br>
                    {{ $opinion->apartament_address }}
                </span>
            </div>
            <div class="col-lg-1 col-12 pl-md-0 pl-lg-3">
                <div class="font-11 d-md-inline-block d-lg-block">Pobyt:</div>
                <div class="font-12 d-md-inline-block d-lg-block">{{ abs((strtotime($opinion->reservation_arrive_date) - strtotime($current_data)) / (60*60*24)) }} dni temu</div>
            </div>
            <div class="col-12 mt-2 desktop-none">Średnia ocen:</div>
            <div class="col-md-4 col-lg-2 px-3 px-md-0">
                <div class="row mx-0 font-11">
                    @for ($i = 0; $i < floor($opinion->ratingAvg/2); $i++)
                        <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star.png") }}'>
                    @endfor
                    @if(floor($opinion->ratingAvg/2) != ceil($opinion->ratingAvg/2))
                        <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star_half.png") }}'>
                    @endif
                    @for ($i = ceil($opinion->ratingAvg/2); $i < 5; $i++)
                        <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star_empty.png") }}'>
                    @endfor
                </div>
                @if($opinion->ratingAvg < 1)
                    <div></div>
                @elseif($opinion->ratingAvg < 2.5)
                    <div class="txt-red"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Awful") }}</div>
                @elseif($opinion->ratingAvg < 4.5)
                    <div class="txt-red"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Bad") }}</div>
                @elseif($opinion->ratingAvg < 6.5)
                    <div class="txt-yellow"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Average") }}</div>
                @elseif($opinion->ratingAvg < 8.5)
                    <div class="txt-green"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Very good") }}</div>
                @else
                    <div class="txt-green"><b>{{ number_format($opinion->ratingAvg, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;{{ __("messages.Perfect") }}</div>
                @endif
                <div class="font-12 txt-blue">{{$opinion->opinionAmount ?? 0}} {{trans_choice('messages.nrReviews', $opinion->opinionAmount ?? 0)}}</div>
            </div>
            <div class="col-md-8 col-lg-4 px-3 px-md-0">
                @if($opinion->total_rating > 0)
                    <div class="col-12 px-0 mt-2 desktop-none">Twoja ocena:</div>
                    <div class="row px-3 pr-md-0">
                        <div class="col-6">
                            <div class="row font-11">
                                @for ($i = 0; $i < floor($opinion->total_rating/2); $i++)
                                    <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star.png") }}'>
                                @endfor
                                @if(floor($opinion->total_rating/2) != ceil($opinion->total_rating/2))
                                    <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star_half.png") }}'>
                                @endif
                                @for ($i = ceil($opinion->total_rating/2); $i < 5; $i++)
                                    <img class="mr-2 mr-lg-1" src='{{ asset("images/opinions/star_empty.png") }}'>
                                @endfor
                            </div>
                            @if($opinion->total_rating < 2.5)
                                <div class="row txt-red"><b>{{ number_format($opinion->total_rating, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;Okropny</div>
                            @elseif($opinion->total_rating < 4.5)
                                <div class="row txt-red"><b>{{ number_format($opinion->total_rating, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;Zły</div>
                            @elseif($opinion->total_rating < 6.5)
                                <div class="row txt-yellow"><b>{{ number_format($opinion->total_rating, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;Średni</div>
                            @elseif($opinion->total_rating < 8.5)
                                <div class="row txt-green"><b>{{ number_format($opinion->total_rating, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;Bardzo dobry</div>
                            @else
                                <div class="row txt-green"><b>{{ number_format($opinion->total_rating, 1, ',', ' ') }}/10</b>&nbsp;&nbsp;Doskonały</div>
                            @endif
                            <div class="row font-12">{{ date("d.m.Y", strtotime($opinion->opinionCreateDate)) }}</div>
                        </div>
                        <div class="col-4 pl-0 pr-3 pr-md-0 font-12 txt-blue">
                            <span class="d-inline d-lg-none">
                                <a class="btn detail" href="#" onClick="getOpinionDetails({{$opinion->id_apartament}}, {{$opinion->id_reservation}})">szczegóły >></a>
                            </span>
                            <span class="d-none d-lg-inline">
                                <button class="btn detail" onClick="getOpinionDetails({{$opinion->id_apartament}}, {{$opinion->id_reservation}})">szczegóły >></button>
                            </span>
                        </div>
                        <div class="col-2 pl-0 pl-md-4 pl-lg-0 pr-0">
                            <img src='{{ asset("images/opinions/trash.png") }}' class="trash-my-opinions img-fluid" onClick="deletePop({{$opinion->id_reservation}})"></img>
                        </div>
                    </div>
                @else
                    <div class="row instead-trash mx-0 px-2 px-md-1">
                        <div class="col-8 font-11">
                            Przekazując informacje na temat pobytu w tym obiekcie pomagasz innym podróżnym podejmować lepsze decyzje.
                        </div>
                        <div class="col-4" style="padding-right: 0px">
                            <a class="btn btn-black pull-right font-12" href="{{ route('account.opinion',['idAparment' => $opinion->apartament_id, 'idReservation' => $opinion->id]) }}">Oceń</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

@endif
</div>

<div id="opinion-detail-popup" style="display: none;">
    <div id="opinion-detail" class="row">
        <div class="col-12 col-md-6 pr-md-3">
            <div class="row opinion-detal gray-box pl-3 pb-3">
                <div class="col-12 pl-0 mb-0">Twoja ocena</div>
                <div class="col-12" id="myTotalWrapper">
                    <img src='{{ asset("images/opinions/star10.png") }}'>
                    <span style="font-weight: bold">
                        <span id="myTotal"></span>/10
                    </span>
                    <span id="myTotalInWords"></span>
                </div>
            </div>
            <div id="comment-wrapper">
                <div id="pros-wraper" class="col-12 row font-12 pl-0 mb-3 ml-1" style="padding-right: 0px; ">
                    <div class="col-2 col-sm-1 col-md-2 center-h-v" style="padding-left: 5px;">
                        <div style="background-color: #4eff5e; color: white; width:16px; height: 16px"><b>+</b></div>
                    </div>
                    <div class="col-10 col-sm-11 col-md-10 comment-row" style="margin-left: -40px; padding-right: 0px">
                        <div id="pros" class="ml-2"></div>
                    </div>
                </div>
                <div id="cons-wraper" class="col-12 row font-12 pl-0 mb-3 ml-1" style="padding-right: 0px">
                    <div class="col-2 col-sm-1 col-md-2 center-h-v" style="padding-left: 5px;">
                        <div style="background-color: #ff2620; color: white; width:16px; height: 16px"><b>-</b></div>
                    </div>
                    <div class="col-10 col-sm-11 col-md-10 comment-row" style="margin-left: -40px; padding-right: 0px">
                        <div id="cons" class="ml-2"></div>
                    </div>
                </div>
            </div>
            <b class="font-11" style="margin-left: 34px">Pobyt: <span id="stay"></span></b>
            <div id="my-opinon-detail" class="py-2" style="border-top: solid 1px gray; width: 304px;">
                <div class="col-12 font-12 mb-2">
                    Czystość
                    <span class="pull-right rating-opinion-detail my-opinion"><span id="user-cleanlinessAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="user-cleanlinessAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Lokalizacja
                    <span class="pull-right rating-opinion-detail my-opinion"><span id="user-locationAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="user-locationAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Udogodnienia
                    <span class="pull-right rating-opinion-detail my-opinion"><span id="user-facilitiesAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="user-facilitiesAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Obsługa
                    <span class="pull-right rating-opinion-detail my-opinion"><span id="user-staffAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="user-staffAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Stosunek jakości do ceny
                    <span class="pull-right rating-opinion-detail my-opinion"><span id="user-quality_per_priceAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="user-quality_per_priceAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
            </div>
            <div id="helpful-wraper" class="py-2" style="display: none; border-top: solid 1px gray; width: 304px;">
                <div id="helpful" class="col-12 font-12 mb-2"></div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <div class="row opinion-detal gray-box pl-0">
                <div class="col-12 mb-0 pl-md-3">Średnia ocena</div>
                <div class="col-12" id="totalAvgWrapper" style="padding-left: 1rem">
                    <img src='{{ asset("images/opinions/star10.png") }}'>
                    <span style="font-weight: bold">
                        <span id="totalAvg"></span>/10
                    </span>
                    <span id="totalAvgInWords"></span>
                </div>
                <div class="col-12 font-11 mb-2 pl-md-3">
                    Na podstawie
                    <span id="opinionsAmountWrapper" class="txt-blue">
                        <span id="opinionsAmount"></span> opinii
                    </span>
                </div>
            </div>
            <div id="opinion-choice" class="font-12">
                <div id="allOpinionsWraper">Wszystkie (<span id="allOpinions"></span>)</div>
                <div id="familyOpinionsWraper">Rodziny (<span id="familyOpinions"></span>)</div>
                <div id="couplesOpinionsWraper">Pary (<span id="couplesOpinions"></span>)</div>
                <div id="businessOpinionsWraper">Biznesowe (<span id="businessOpinions"></span>)</div>
                <div id="withFriendsOpinionsWraper">Ze znajomymi (<span id="withFriendsOpinions"></span>)</div>
                <div id="aloneOpinionsWraper">W pojedynkę (<span id="aloneOpinions"></span>)</div>
            </div>
            <div class="avgBars font-12">
                <div id="perfect" class="row">
                    <div class="side left">
                        <div>Doskonały</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div style="width: 30%; background-color: #00f324;"></div>
                        </div>
                    </div>
                    <div class="side right">20</div>
                </div>

                <div id="very-good" class="row">
                    <div class="side left">
                        <div>Bardzo dobry</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div style="width: 70%; background-color: #00f324;"></div>
                        </div>
                    </div>
                    <div class="side right">6</div>
                </div>

                <div id="average" class="row">
                    <div class="side left">
                        <div>Średni</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div style="width: 70%; background-color: #f3ef00;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>9</div>
                    </div>
                </div>

                <div id="bad" class="row">
                    <div class="side left">
                        <div>Zły</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div style="width: 70%; background-color: #f30019;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>9</div>
                    </div>
                </div>

                <div id="awful" class="row">
                    <div class="side left">
                        <div>Okropny</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div style="width: 70%; background-color: #f30019;"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div>9</div>
                    </div>
                </div>
            </div>
            <div class="py-2" style="border-top: solid 1px gray; margin-bottom: 46px; width: 304px;">
                <div class="col-12 font-12 mb-2">
                    Czystość
                    <span class="pull-right rating-opinion-detail"><span id="cleanlinessAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="cleanlinessAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Lokalizacja
                    <span class="pull-right rating-opinion-detail"><span id="locationAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="locationAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Udogodnienia
                    <span class="pull-right rating-opinion-detail"><span id="facilitiesAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="facilitiesAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Obsługa
                    <span class="pull-right rating-opinion-detail"><span id="staffAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="staffAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
                <div class="col-12 font-12 mb-2">
                    Stosunek jakości do ceny
                    <span class="pull-right rating-opinion-detail"><span id="quality_per_priceAvg"></span></span>
                    <span class="pull-right" style="background-color: #fff">
                        <img id="quality_per_priceAvgImg" src='{{ asset("images/opinions/dot.png") }}'>
                    </span>
                </div>
            </div>
        </div>
        <div id="cancel-opinion-detail"><span class="center-h-v"><b>x</b></span></div>
        {{--<div style="background-image: url('{{ asset("images/opinions/loader.gif") }}'); background-size: cover; margin-bottom: 0px; width: 60px; height: 60px;"></div>
        --}}
    </div>
</div>

<div id="confirm-delete-pop" style="display: none">
    <h4 class="p-3"><b>Czy na pewno chcesz usunąć opinię?</b></h4>
    <div class="px-3">Operacja jest nieodwracalna</div>
    <div class="col-12 mb-4 mt-2">
        <div class="btn btn-black" id="confirm-delete" onclick="deleteOpinion(opinionToDelete)" style="width: 100%; font-size: 18px">Potwierdź</div>
        <div class="btn" id="cancel-delete" style="width: 100%; font-size: 18px">Anuluj</div>
    </div>
</div>

<script>


    $("#cancel-opinion-detail").on('click', function(){
        $('#opinion-detail-popup').css('display', 'none');
    });

    $("#opinion-detail").click(function(event) {
        event.stopPropagation();
    });

    var dataFromAjax;

    $("#allOpinionsWraper").on('click', function(){
        setJourneyType(0);
        setBars(7);
    });

    $("#familyOpinionsWraper").on('click', function(){
        setJourneyType(2);
        setBars(8);
    });

    $("#couplesOpinionsWraper").on('click', function(){
        setJourneyType(3);
        setBars(9);
    });

    $("#businessOpinionsWraper").on('click', function(){
        setJourneyType(4);
        setBars(10);
    });

    $("#withFriendsOpinionsWraper").on('click', function(){
        setJourneyType(5);
        setBars(11);
    });

    $("#aloneOpinionsWraper").on('click', function(){
        setJourneyType(6);
        setBars(12);
    });

    $("#opinion-choice div").on('click', function(){
        $("#opinion-choice div").removeClass();
        $(this).addClass("clicked");
    });

    function getOpinionDetails(apartamentId, reservationId){
        $.ajax({
            type: "GET",
            url: '/account/getOpinionDetails/'+apartamentId+'/'+reservationId,
            dataType : 'json',
            data: {
                apartamentId: apartamentId,
                reservationId: reservationId,
            },
            success: function(data) {
                //set data to quick sort in popup
                dataFromAjax = data;
                $("#opinionsAmount").text(data[0].opinionsAmount);
                var totalRating = parseFloat(data[1].total_rating).toFixed(1);
                $("#myTotal").text(totalRating);
                var totalAvg = parseFloat(data[0].totalAvg).toFixed(1);
                $("#totalAvg").text(totalAvg);

                //set stay month name and year
                var dateObj = new Date();
                var month = dateObj.getUTCMonth() + 1; //months from 1-12
                var day = dateObj.getUTCDate();
                var year = dateObj.getUTCFullYear();
                newdate = year + "/" + month + "/" + day;
                locale = "pl",
                month = dateObj.toLocaleString(locale, { month: "long" });
                $("#stay").text(month +" "+ year);

                //set my total rating in words
                $("#myTotalWrapper").removeClass();
                if(data[1].total_rating < 2.5){
                    $("#myTotalInWords").text("Okropny");
                    $("#myTotalWrapper").addClass('txt-red');
                }
                else if(data[1].total_rating < 4.5){
                    $("#myTotalInWords").text("Zły");
                    $("#myTotalWrapper").addClass('txt-red');

                }
                else if(data[1].total_rating < 6.5){
                    $("#myTotalInWords").text("Średni");
                    $("#myTotalWrapper").addClass('txt-yellow');
                }
                else if(data[1].total_rating < 8.5){
                    $("#myTotalInWords").text("Bardzo dobry");
                    $("#myTotalWrapper").addClass('txt-green');
                }
                else {
                    $("#myTotalInWords").text("Doskonały");
                    $("#myTotalWrapper").addClass('txt-green');
                }
                if(data[1].total_rating == null) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star1.png") }}');
                else if(data[1].total_rating < 1.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star1.png") }}');
                else if(data[1].total_rating < 2.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star2.png") }}');
                else if(data[1].total_rating < 3.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star3.png") }}');
                else if(data[1].total_rating < 4.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star4.png") }}');
                else if(data[1].total_rating < 5.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star5.png") }}');
                else if(data[1].total_rating < 6.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star6.png") }}');
                else if(data[1].total_rating < 7.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star7.png") }}');
                else if(data[1].total_rating < 8.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star8.png") }}');
                else if(data[1].total_rating < 9.5) $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star9.png") }}');
                else $("#myTotalWrapper img").attr("src",'{{ asset("images/opinions/star10.png") }}')

                //set total avg rating in words
                $("#totalAvgWrapper").removeClass();
                if(data[0].totalAvg < 2.5){
                    $("#totalAvgInWords").text("Okropny");
                    $("#totalAvgWrapper").addClass('txt-red');
                }
                else if(data[0].totalAvg < 4.5){
                    $("#totalAvgInWords").text("Zły");
                    $("#totalAvgWrapper").addClass('txt-red');

                }
                else if(data[0].totalAvg < 6.5){
                    $("#totalAvgInWords").text("Średni");
                    $("#totalAvgWrapper").addClass('txt-yellow');
                }
                else if(data[0].totalAvg < 8.5){
                    $("#totalAvgInWords").text("Bardzo dobry");
                    $("#totalAvgWrapper").addClass('txt-green');
                }
                else {
                    $("#totalAvgInWords").text("Doskonały");
                    $("#totalAvgWrapper").addClass('txt-green');
                }
                if(data[0].totalAvg == null) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star1.png") }}');
                else if(data[0].totalAvg < 1.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star1.png") }}');
                else if(data[0].totalAvg < 2.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star2.png") }}');
                else if(data[0].totalAvg < 3.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star3.png") }}');
                else if(data[0].totalAvg < 4.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star4.png") }}');
                else if(data[0].totalAvg < 5.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star5.png") }}');
                else if(data[0].totalAvg < 6.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star6.png") }}');
                else if(data[0].totalAvg < 7.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star7.png") }}');
                else if(data[0].totalAvg < 8.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star8.png") }}');
                else if(data[0].totalAvg < 9.5) $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star9.png") }}');
                else $("#totalAvgWrapper img").attr("src",'{{ asset("images/opinions/star10.png") }}');

                //fill bars for all journey types
                setBars(7);

                $("#allOpinions").text(data[0].opinionsAmount);

                if(data[2].opinionsAmount == 0) $("#familyOpinionsWraper").hide();
                else{
                    $("#familyOpinionsWraper").show();
                    $("#familyOpinions").text(data[2].opinionsAmount);
                }

                if(data[3].opinionsAmount == 0) $("#couplesOpinionsWraper").hide();
                else{
                    $("#couplesOpinionsWraper").show();
                    $("#couplesOpinions").text(data[3].opinionsAmount);
                }

                if(data[4].opinionsAmount == 0) $("#businessOpinionsWraper").hide();
                else{
                    $("#businessOpinionsWraper").show();
                    $("#businessOpinions").text(data[4].opinionsAmount);
                }

                if(data[5].opinionsAmount == 0) $("#withFriendsOpinionsWraper").hide();
                else{
                    $("#withFriendsOpinionsWraper").show();
                    $("#withFriendsOpinions").text(data[5].opinionsAmount);
                }

                if(data[6].opinionsAmount == 0) $("#aloneOpinionsWraper").hide();
                else{
                    $("#aloneOpinionsWraper").show();
                    $("#aloneOpinions").text(data[6].opinionsAmount);
                }

                $(".rating-opinion-detail span").removeClass();

                ///rating for all type opinions
                setJourneyType(0);

                ///////////user rating
                $("#user-totalAvg").text(data[1].totalAvg);
                $("#user-cleanlinessAvg").text(data[1].cleanliness);
                $("#user-locationAvg").text(data[1].location);
                $("#user-facilitiesAvg").text(data[1].facilities);
                $("#user-staffAvg").text(data[1].staff);
                $("#user-quality_per_priceAvg").text(data[1].quality_per_price);

                if(data[1].cleanliness <= 3){
                    $("#user-cleanlinessAvg").addClass("rating-red");
                }
                else if(data[1].cleanliness > 3 && data[1].cleanliness <= 6){
                    $("#user-cleanlinessAvg").addClass("rating-yellow");
                }
                else if(data[1].cleanliness > 6){
                    $("#user-cleanlinessAvg").addClass("rating-green");
                }
                if(data[1].cleanliness == null) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
                else if(data[1].cleanliness < 1.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
                else if(data[1].cleanliness < 2.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
                else if(data[1].cleanliness < 3.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
                else if(data[1].cleanliness < 4.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
                else if(data[1].cleanliness < 5.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
                else if(data[1].cleanliness < 6.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
                else if(data[1].cleanliness < 7.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
                else if(data[1].cleanliness < 8.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
                else if(data[1].cleanliness < 9.5) $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
                else $("#user-cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

                if(data[1].location <= 3){
                    $("#user-locationAvg").addClass("rating-red");
                }
                else if(data[1].location > 3 && data[1].location <= 6){
                    $("#user-locationAvg").addClass("rating-yellow");
                }
                else if(data[1].location > 6){
                    $("#user-locationAvg").addClass("rating-green");
                }
                if(data[1].location == null) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
                else if(data[1].location < 1.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
                else if(data[1].location < 2.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
                else if(data[1].location < 3.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
                else if(data[1].location < 4.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
                else if(data[1].location < 5.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
                else if(data[1].location < 6.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
                else if(data[1].location < 7.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
                else if(data[1].location < 8.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
                else if(data[1].location < 9.5) $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
                else $("#user-locationAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

                if(data[1].facilities <= 3){
                    $("#user-facilitiesAvg").addClass("rating-red");
                }
                else if(data[1].facilities > 3 && data[1].facilities <= 6){
                    $("#user-facilitiesAvg").addClass("rating-yellow");
                }
                else if(data[1].facilities > 6){
                    $("#user-facilitiesAvg").addClass("rating-green");
                }
                if(data[1].facilities == null) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
                else if(data[1].facilities < 1.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
                else if(data[1].facilities < 2.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
                else if(data[1].facilities < 3.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
                else if(data[1].facilities < 4.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
                else if(data[1].facilities < 5.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
                else if(data[1].facilities < 6.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
                else if(data[1].facilities < 7.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
                else if(data[1].facilities < 8.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
                else if(data[1].facilities < 9.5) $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
                else $("#user-facilitiesAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

                if(data[1].staff <= 3){
                    $("#user-staffAvg").addClass("rating-red");
                }
                else if(data[1].staff > 3 && data[1].staff <= 6){
                    $("#user-staffAvg").addClass("rating-yellow");
                }
                else if(data[1].staff > 6){
                    $("#user-staffAvg").addClass("rating-green");
                }
                if(data[1].staff == null) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
                else if(data[1].staff < 1.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
                else if(data[1].staff < 2.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
                else if(data[1].staff < 3.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
                else if(data[1].staff < 4.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
                else if(data[1].staff < 5.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
                else if(data[1].staff < 6.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
                else if(data[1].staff < 7.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
                else if(data[1].staff < 8.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
                else if(data[1].staff < 9.5) $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
                else $("#user-staffAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

                if(data[1].quality_per_price <= 3){
                    $("#user-quality_per_priceAvg").addClass("rating-red");
                }
                else if(data[1].quality_per_price > 3 && data[1].quality_per_price <= 6){
                    $("#user-quality_per_priceAvg").addClass("rating-yellow");
                }
                else if(data[1].quality_per_price > 6){
                    $("#user-quality_per_priceAvg").addClass("rating-green");
                }
                if(data[1].quality_per_price == null) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
                else if(data[1].quality_per_price < 1.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
                else if(data[1].quality_per_price < 2.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
                else if(data[1].quality_per_price < 3.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
                else if(data[1].quality_per_price < 4.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
                else if(data[1].quality_per_price < 5.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
                else if(data[1].quality_per_price < 6.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
                else if(data[1].quality_per_price < 7.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
                else if(data[1].quality_per_price < 8.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
                else if(data[1].quality_per_price < 9.5) $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
                else $("#user-quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

                if(data[1].helpful != null){
                    $("#helpful-wraper").css({'display':'block'});
                    $("#helpful").html("<b>"+data[1].helpful+"</b> osoby uznały opinię za pomocną");
                }
                else $("#helpful-wraper").css({'display':'none'});

                if(data[1].pros != null){
                    $("#pros-wraper").css({'display':'flex'});
                    $("#pros").html(data[1].pros);
                }
                else $("#pros-wraper").css({'display':'none'});

                if(data[1].cons != null){
                    $("#cons-wraper").css({'display':'flex'});
                    $("#cons").html(data[1].cons);
                }
                else $("#cons-wraper").css({'display':'none'});

                $('#opinion-detail-popup').css('display', 'block');
                $('#opinion-choice .clicked').removeClass('clicked');
                $('#allOpinionsWraper').addClass('clicked');

            },
            error: function(data) {
                console.log("Fail");
                console.log(data);
            },
        });
    }

    function setBars(type){
        $("#perfect .side.right").text(dataFromAjax[type][0].amount);
        $("#very-good .side.right").text(dataFromAjax[type][1].amount);
        $("#average .side.right").text(dataFromAjax[type][2].amount);
        $("#bad .side.right").text(dataFromAjax[type][3].amount);
        $("#awful .side.right").text(dataFromAjax[type][4].amount);

        if(type == 7) var allOpinions = dataFromAjax[0].opinionsAmount;
        else var allOpinions = dataFromAjax[type-6].opinionsAmount;

        if (dataFromAjax[type][0].amount == 0) $("#perfect .bar-container>div").css({'width': "0%"});
        else $("#perfect .bar-container>div").css({'width': dataFromAjax[type][0].amount / allOpinions * 100 +"%"});

        if (dataFromAjax[type][1].amount == 0) $("#very-good .bar-container>div").css({'width': "0%"});
        else $("#very-good .bar-container>div").css({'width': dataFromAjax[type][1].amount / allOpinions * 100 +"%"});

        if (dataFromAjax[type][2].amount == 0) $("#average .bar-container>div").css({'width': "0%"});
        else $("#average .bar-container>div").css({'width': dataFromAjax[type][2].amount / allOpinions * 100 +"%"});

        if (dataFromAjax[type][3].amount == 0) $("#bad .bar-container>div").css({'width': "0%"});
        else $("#bad .bar-container>div").css({'width': dataFromAjax[type][3].amount / allOpinions * 100 +"%"});

        if (dataFromAjax[type][4].amount == 0) $("#awful .bar-container>div").css({'width': "0%"});
        else $("#awful .bar-container>div").css({'width': dataFromAjax[type][4].amount / allOpinions * 100 +"%"});
    }

    function setJourneyType(type){
        $("#cleanlinessAvg").text(dataFromAjax[type].cleanlinessAvg);
        $("#locationAvg").text(dataFromAjax[type].locationAvg);
        $("#facilitiesAvg").text(dataFromAjax[type].facilitiesAvg);
        $("#staffAvg").text(dataFromAjax[type].staffAvg);
        $("#quality_per_priceAvg").text(dataFromAjax[type].quality_per_priceAvg);

        //clear classes for all rating divs
        $(".rating-opinion-detail:not(.my-opinion) span").removeClass();

        if(dataFromAjax[type].cleanlinessAvg <= 3 && dataFromAjax[type].cleanlinessAvg >= 1){
            $("#cleanlinessAvg").addClass("rating-red");
        }
        else if(dataFromAjax[type].cleanlinessAvg > 3 && dataFromAjax[type].cleanlinessAvg <= 6){
            $("#cleanlinessAvg").addClass("rating-yellow");
        }
        else if(dataFromAjax[type].cleanlinessAvg > 6){
            $("#cleanlinessAvg").addClass("rating-green");
        }
        if(dataFromAjax[type].cleanlinessAvg == null) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 1.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 2.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 3.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 4.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 5.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 6.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 7.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 8.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
        else if(dataFromAjax[type].cleanlinessAvg < 9.5) $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
        else $("#cleanlinessAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

        if(dataFromAjax[type].locationAvg <= 3 && dataFromAjax[type].locationAvg >= 1){
            $("#locationAvg").addClass("rating-red");
        }
        else if(dataFromAjax[type].locationAvg > 3 && dataFromAjax[type].locationAvg <= 6){
            $("#locationAvg").addClass("rating-yellow");
        }
        else if(dataFromAjax[type].locationAvg > 6){
            $("#locationAvg").addClass("rating-green");
        }
        if(dataFromAjax[type].locationAvg == null) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
        else if(dataFromAjax[type].locationAvg < 1.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
        else if(dataFromAjax[type].locationAvg < 2.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
        else if(dataFromAjax[type].locationAvg < 3.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
        else if(dataFromAjax[type].locationAvg < 4.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
        else if(dataFromAjax[type].locationAvg < 5.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
        else if(dataFromAjax[type].locationAvg < 6.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
        else if(dataFromAjax[type].locationAvg < 7.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
        else if(dataFromAjax[type].locationAvg < 8.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
        else if(dataFromAjax[type].locationAvg < 9.5) $("#locationAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
        else $("#locationAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

        if(dataFromAjax[type].facilitiesAvg <= 3 && dataFromAjax[type].facilitiesAvg >= 1){
            $("#facilitiesAvg").addClass("rating-red");
        }
        else if(dataFromAjax[type].facilitiesAvg > 3 && dataFromAjax[type].facilitiesAvg <= 6){
            $("#facilitiesAvg").addClass("rating-yellow");
        }
        else if(dataFromAjax[type].facilitiesAvg > 6){
            $("#facilitiesAvg").addClass("rating-green");
        }
        if(dataFromAjax[type].facilitiesAvg == null) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 1.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 2.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 3.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 4.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 5.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 6.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 7.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 8.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
        else if(dataFromAjax[type].facilitiesAvg < 9.5) $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
        else $("#facilitiesAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

        if(dataFromAjax[type].staffAvg <= 3 && dataFromAjax[type].staffAvg >= 1){
            $("#staffAvg").addClass("rating-red");
        }
        else if(dataFromAjax[type].staffAvg > 3 && dataFromAjax[type].staffAvg <= 6){
            $("#staffAvg").addClass("rating-yellow");
        }
        else if(dataFromAjax[type].staffAvg > 6){
            $("#staffAvg").addClass("rating-green");
        }
        if(dataFromAjax[type].staffAvg == null) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
        else if(dataFromAjax[type].staffAvg < 1.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
        else if(dataFromAjax[type].staffAvg < 2.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
        else if(dataFromAjax[type].staffAvg < 3.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
        else if(dataFromAjax[type].staffAvg < 4.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
        else if(dataFromAjax[type].staffAvg < 5.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
        else if(dataFromAjax[type].staffAvg < 6.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
        else if(dataFromAjax[type].staffAvg < 7.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
        else if(dataFromAjax[type].staffAvg < 8.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
        else if(dataFromAjax[type].staffAvg < 9.5) $("#staffAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
        else $("#staffAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');

        if(dataFromAjax[type].quality_per_priceAvg <= 3 && dataFromAjax[type].quality_per_priceAvg >= 1){
            $("#quality_per_priceAvg").addClass("rating-red");
        }
        else if(dataFromAjax[type].quality_per_priceAvg > 3 && dataFromAjax[type].quality_per_priceAvg <= 6){
            $("#quality_per_priceAvg").addClass("rating-yellow");
        }
        else if(dataFromAjax[type].quality_per_priceAvg > 6){
            $("#quality_per_priceAvg").addClass("rating-green");
        }
        if(dataFromAjax[type].quality_per_priceAvg == null) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/0.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 1.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/1.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 2.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/2.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 3.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/3.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 4.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/4.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 5.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/5.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 6.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/6.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 7.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/7.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 8.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/8.png") }}');
        else if(dataFromAjax[type].quality_per_priceAvg < 9.5) $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/9.png") }}');
        else $("#quality_per_priceAvgImg").attr("src",'{{ asset("images/opinions/10.png") }}');
    }

    opinionToDelete = 0;

    function deletePop(toDelete){
        opinionToDelete = toDelete;
        $("#confirm-delete-pop").css({'display': 'block'});
    }

    function deleteOpinion(opinionToDelete) {
        console.log('usuwanie: ' + opinionToDelete);
        $.ajax({
            type: "GET",
            url: '/account/opinion/'+ opinionToDelete,
            dataType: 'json',
            data: {
                opinionToDelete: opinionToDelete
            },
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log("Fail");
                console.log(data);
            },
        });
    }

    $("#cancel-delete").on('click', function(){
        $("#confirm-delete-pop").css({'display': 'none'});
    });

</script>

@endsection