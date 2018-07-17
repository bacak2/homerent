@extends ('layout.layout')
@section('title', 'O firmie')

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <h1 class="h1-owners mt-5">O firmie</h1>
    <div id="about-us-aggregate" class="row">
        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/Group_User_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">250 847 gości</div>
                        <div class="font-13">zarezerwowało noclegi</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/Hotel_Sign_1_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">15 878 noclegów</div>
                        <div class="font-13">dostępnych w serwisie</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/User_Message1_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">8 471 opinii</div>
                        <div class="font-13">które pomogą podróżującym w decyzji</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/Globe1_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">178 miejcowości</div>
                        <div class="font-13">w Polsce</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <img style="width: 100%; height: auto; margin-bottom: 30px" src='{{ asset("images/about_us/photo1.png") }}'>
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/photo1.png") }}'>

    <h2 class="mt-4 mb-3 h2-owners">O serwisie</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
    </p>
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/photo1.png") }}'>

    <h2 class="mt-4 mb-3 h2-owners">Kim jesteśmy</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
    </p>

    <div class="mb-5">
        <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
            <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
            <div class="font-11 bold">Jan Kowalski</div>
            <div class="font-11">Prezes</div>
        </div>
        <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
            <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
            <div class="font-11 bold">Anna Nowak</div>
            <div class="font-11">Główna księgowa</div>
        </div>
        <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
            <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
            <div class="font-11 bold">Anna Nowak</div>
            <div class="font-11">Biuro Obsługi Klienta</div>
        </div>
        <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
            <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
            <div class="font-11 bold">Anna Nowak</div>
            <div class="font-11">Lorem ipsum</div>
        </div>
        <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
            <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
            <div class="font-11 bold">Anna Nowak</div>
            <div class="font-11">Lorem ipsum</div>
        </div>
    </div>


</div>
@endsection