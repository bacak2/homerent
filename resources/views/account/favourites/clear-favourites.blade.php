<div id="truncate-favourites">
    <span style="font-size: 32px; font-weight: bold">{{ __('messages.My favourites') }}</span>
    <p class="font-13">
        {{ __('messages.FavDeleted') }} <a href="#" id="cancel-truncate" class="txt-blue">{{ __('messages.Undo') }}</a>
    </p>
    <div id="close-truncate" class="close-truncate">x</div>
    <button class="btn btn-default close-truncate">OK</button>
</div>
<script>
    function clearFavouritesPopup(){
        $("#truncate-favourites").show();
        $("#favourites-bar").hide();
        $("#favourites-nav").text('{{ __('messages.My favourites') }} (0)');
        $(".display-favourites").css('visibility', 'hidden');
        if($("#send-to").css("display") != "none") $("#send-to").hide();
    }

    $("#clear-favourites-in-header").on('click', function(){
        clearFavouritesPopup();
    });

    $("#clear-favourites").on('click', function(){
        clearFavouritesPopup();
    });

    $("#cancel-truncate").on('click', function(){
        location.reload();
    });

    $(".close-truncate").on('click', function(){
        $.ajax({
            type: "GET",
            url: '/truncateFavourites/'+{{Auth::user()->id}},
            dataType : 'json',
            data: {
                userId: {{Auth::user()->id}},
            },
            success: function() {
                location.reload();
            },
            error: function() {
                console.log( "Error in connection with controller");
            },
        });
    });
</script>