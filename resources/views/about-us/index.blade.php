@extends ('layout.layout')
@section('title', __('messages.About company'))

@section('content')
<div class="container">
    <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/mainImg.png") }}'>

    <h1 class="h1-owners mt-5">{{__('messages.About company')}}</h1>
    <div id="about-us-aggregate" class="row">
        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/Group_User_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">{{ countAllReservations() }} {{__('messages.guests')}}</div>
                        <div class="font-13">{{__('messages.booked accommodation')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/Hotel_Sign_1_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">{{ countAllApartments() }} {{__('messages.accommodation')}}</div>
                        <div class="font-13">{{__('messages.available on the website')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/User_Message1_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">{{ countAllOpinions() }} {{__('messages.reviews_number')}}</div>
                        <div class="font-13">{{__('messages.that will help travelers in the decision')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 pl-3 mb-3">
            <div style="padding: 12px 16px 16px 16px; background-color: #F2F2F2; border: 1px solid #CCCCCC;">
                <div class="row">
                    <div class="col-3 col-md-2 pt-1"><img src='{{ asset("images/about_us/Globe1_48.png") }}'></div>
                    <div class="col-9 col-md-10">
                        <div class="h2-owners">3 {{__('messages.places')}}</div>
                        <div class="font-13">{{__('messages.in Poland')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4">{{__('messages.aboutUs1')}}</div>
    <div class="mb-4">{{__('messages.aboutUs2')}}</div>
    <div class="mb-4">{{__('messages.aboutUs3')}}</div>

    {{--
        <img style="width: 100%; height: auto; margin-bottom: 30px" src='{{ asset("images/about_us/photo1.png") }}'>
        <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/photo1.png") }}'>

        <h2 class="mt-4 mb-3 h2-owners">{{__('messages.About service')}}</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </p>
        <img style="width: 100%; height: auto;" src='{{ asset("images/about_us/photo1.png") }}'>

        <h2 class="mt-4 mb-3 h2-owners">{{__('messages.Who we are')}}</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
        </p>

        <div class="mb-5">
            <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
                <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
                <div class="font-11 bold">Jan Kowalski</div>
                <div class="font-11">{{__('messages.Chairman')}}</div>
            </div>
            <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
                <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
                <div class="font-11 bold">Anna Nowak</div>
                <div class="font-11">{{__('messages.Chief accountant')}}</div>
            </div>
            <div class="pr-2 pr-md-3 pt-3 pt-md-1" style="display: inline-block">
                <img src='{{ asset("images/about_us/chairmanPhoto.png") }}'>
                <div class="font-11 bold">Anna Nowak</div>
                <div class="font-11">{{__('messages.bok')}}</div>
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
        --}}


</div>
@endsection