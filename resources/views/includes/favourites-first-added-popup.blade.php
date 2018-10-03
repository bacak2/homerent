<div id="first-added-favourites">
    <span style="font-size: 24px; font-weight: bold">{{__('messages.FavFirstAdded1')}}</span>
    <p class="font-13">{{__('messages.FavFirstAdded2')}}</p>
    @notmobile
    <p class="font-13 mb-0">{{__('messages.FavFirstAdded3')}}</p>
    <img src={{ asset("images/apartment_detal/addedToFavourites_").\App::getLocale().".png"}}>
    @endnotmobile
    <div id="close-first-added" class="close-first-added">x</div>
    <button class="btn btn-default close-first-added">{{__('messages.Close')}}</button>
</div>
<script>
    $(".close-first-added").on('click', function(){
        $("#first-added-favourites").hide();
    });
</script>