@extends ('layout.layout')

@section('title', __('messages.My favourites') )

@section('content')

<div class="container">
    <h1>{{__('messages.My favourites')}}</h1>
    <div class="row" style="margin-bottom: 40px">
        <div class="col-3 col-sm-2">
            {{__('messages.Add to favorites')}}
        </div>
        <div class="col-1 col-sm-2">
            <img class="d-inline d-md-none" src="{{ asset("images/favourites/emptyArrowMobile.png") }}">
            <img class="d-none d-md-inline w-75" src="{{ asset("images/favourites/emptyArrow.png") }}">
        </div>
        <div class="col-3 col-sm-2">
            {{__('messages.Compare objects')}}
        </div>
        <div class="col-1 col-sm-2">
            <img class="d-inline d-md-none" src="{{ asset("images/favourites/emptyArrowMobile.png") }}">
            <img class="d-none d-md-inline w-75" src="{{ asset("images/favourites/emptyArrow.png") }}">
        </div>
        <div class="col-3 col-sm-2">
            {{__('messages.Send to friends')}}
        </div>
    </div>
    <div class="row" style="margin-bottom: 88px">
        <div class="col-12">
            <h2>{{__('messages.How add object to favourites?')}}</h2>
        </div>
        <div class="col-12 col-md-6">
            <br>
            <span>
                {{__('messages.Click the heart icon in the upper right corner of the site announcement.')}}
            </span>
            <br><br>
            <img @mobile style="width: 100%" @endmobile src="{{ asset("images/favourites/empty1.png") }}">
        </div>
        <div class="col-12 col-md-6">
            <br>
            <span>
                {{__('messages.Or on the apartment side')}}
            </span>
            <br><br>
            <img @mobile style="width: 100%" @endmobile src="{{ asset("images/favourites/empty2.png") }}">
        </div>
    </div>
</div>

@endsection