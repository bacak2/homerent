<div id="first-added-favourites">
    <span style="font-size: 24px; font-weight: bold">Obiekt został dodany do ulubionych</span>
    <p class="font-13">Jeśli dodasz więcej obiektów do ulubionych, można je będzie porównać lub wysłać całą ich listę na podany adres e-mail.</p>
    <p class="font-13">Znajdziesz je tutaj:</p>
    <img src={{ asset("images/apartment_detal/addedToFavourites.png") }}>
    <div id="close-first-added" class="close-first-added">x</div>
    <button class="btn btn-default close-first-added">Zamknij</button>
</div>
<script>
    $(".close-first-added").on('click', function(){
        $("#first-added-favourites").hide();
    });
</script>