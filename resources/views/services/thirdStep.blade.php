<form style="display:none" id="DotpayForm" name="do_platnosci" method="POST" action="https://ssl.dotpay.pl/test_payment/">
    <input type="hidden" name="id" value="734129" />
    <input type="hidden" name="opis" value="Zasilenie konta w portalu PAWELDANIELEWSKI.PL" />
    <input type="hidden" name="control" value="" />
    <input type="hidden" name="amount" value="100" />
    <input type="hidden" name="typ" value="3" />
    <input type="hidden" name="URL" value="http://paweldanielewski.pl/koniec.php" />
    <input type="hidden" name="URLC" value="http://paweldanielewski.pl/dotpay.php" />
    <input type="submit" name="dalej" value="zapłać teraz" />
</form>
<script>
    document.getElementById("DotpayForm").submit();
</script>
@section('reservation.content')
    <div class="container">
        <h1><b>{{ __('messages.reservation') }}</b></h1>
    </div>
    <div class="container flex-box mb-2">
        <div id="Rtitle"><h2><b>1. {{ __('messages.offer') }}</b></h2></div>
        <div class="mobile-none font-12" id="Rpath">
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/thisStepBlack.png") }}'>
                <span class="active number">1</span>
                <span class="activeBold ml-2">{{ __('messages.offer') }}</span>
            </div>
            <img class="mx-2" src='{{ asset("images/reservations/lineActive.png") }}'>
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/fullLight.png") }}'>
                <span class="number">2</span>
                <span class="not-active ml-2">{{ __('messages.your data') }}</span>
            </div>
            <img class="mx-2" src='{{ asset("images/reservations/lineNotActive.png") }}'>
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/fullLight.png") }}'>
                <span class="number">3</span>
                <span class="not-active ml-2">{{ __('messages.payment') }}</span>
            </div>
            <img class="mx-2" src='{{ asset("images/reservations/lineNotActive.png") }}'>
            <div class="reservation-path">
                <img src='{{ asset("images/reservations/fullLight.png") }}'>
                <span class="number">4</span>
                <span class="not-active ml-2">{{ __('messages.confirmation') }}</span>
            </div>
        </div>
        <div class="desktop-none" id="Rpath"><span class="activeBold">{{ __('messages.offer') }}</span> - {{ __('messages.your data') }} - {{ __('messages.payment') }} - {{ __('messages.confirmation') }}</div>
    </div>