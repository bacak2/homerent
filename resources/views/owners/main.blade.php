@extends ('layout.layout')
@section('title', 'Dla właścicieli')

@section('content')
<div class="container">
    <div class="img-container" style="position: relative">
        <img style="width: 100%; height: auto; min-height: 270px;" src='{{ asset("images/for_owners/mainImg.png") }}'>
        <span style="position: absolute; left: 30px; bottom: 30px">
            <h1 class="h1-owners">Zarabiaj pieniądze wynajmując z nami swój apartament</h1>
            <a href="{{route('owners.firstStep')}}" class="btn btn-black">Dodaj ofertę</a>
        </span>
    </div>

    <h2 class="mt-4 mb-3 h2-owners">Dlaczego warto</h2>
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="row mb-md-5 mb-3">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/procent.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">Za darmo</h3><span class="font-13">Nie pobieramy opłat za rejestrację i zarządzanie apartamentem.</span></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-md-5 mb-3">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/Check_House_96.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">Bez wyłączności</h3><span class="font-13">Współpracuj z kim chcesz. Możesz dodawać swój apartament do wielu serwisów - pamiętaj jedynie o aktualizacji kalendarza dostępności.</span></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-md-5 mb-3">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/Online_Real_Estate_96.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">Rezerwacje online</h3><span class="font-13">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</span></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-md-5 mb-3">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">Lorem ipsum</h3><span class="font-13">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</span></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-md-5 mb-3">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-8"><h3 class="h3-owners">Lorem ipsum</h3><span class="font-13">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.</span></div>
            </div>
        </div>
    </div>

    <div class="mb-5" style="position: relative">
        <img style="width: 100%; height: 5px;" src='{{ asset("images/for_owners/belt.png") }}'>
        <span style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <a href="{{route('owners.firstStep')}}" style="width: 212px" class="btn btn-black">Dodaj ofertę</a>
        </span>
    </div>

    <h2 class="mobile-none mt-4 h2-owners">Masz pytania?</h2>
    <div class="row mobile-none" style="margin-bottom: 60px">
        <div class="col-sm-12 col-md-6">
            <div style="font-size: 20px;" class="bold mt-3 mb-4">Skontaktuj się z nami</div>
            <div style="width:100%; min-height: 125px; background-color: #cfcfcf; border: 1px solid black; width: 408px; padding: 20px">
                <div class="mr-2" style="float: left"><img src='{{ asset("images/for_owners/Call_48.png") }}'></div>
                <span style="font-size: 20px; display: inline-block">tel: +22 111 11 11, 600-000-000</span>
                <span class="font-13" style="display: inline-block">pn-pt, 8:00-18:00</span>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div style="font-size: 20px;" class="bold mt-3 mb-4">lub pozwól nam się skontaktować</div>
            <div>
                <form>
                    <div class="row">
                        <div class="col-6">
                            <label for="nameAndSurname" class="font-13 mb-4">Imię i nazwisko</label>
                            <input type="text" id="nameAndSurname" name="nameAndSurname" style="width: 100%; height: 25px">
                        </div>
                        <div class="col-6">
                            <label for="email" class="font-13 mb-4">E-mail lub numer telefonu</label>
                            <input type="text" id="email" name="email" style="width: 100%; height: 25px">
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="font-13 pull-left mt-2">Skontaktujemy się z Tobą w ciągu 24 godzin</span>
                        <input class="btn btn-black pull-right" style="width: 202px" type="submit" value="Wyślij formularz">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row py-3" style="background-color: #cfcfcf">
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. "
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Joanna, Zakopane</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. "
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Joanna, Zakopane</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-sm-30">
                <div class="col-4"><img style="width: 100%; height: auto;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-8">
                    <span class="font-16 font-m-13">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. "
                    </span>
                    <br><br>
                    <span class="font-13 font-m-11">Joanna, Zakopane</span>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-4 h2-owners">Media o nas</h2>
    <div class="row mb-5">
        <div class="col-sm-12 col-md-4">
            <div class="row mb-4">
                <div class="col-5"><img style="width: 100%; height: 60px;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-7">
                    <a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a>
                    <br>
                    <span class="font-13">Dziennik Bałtycki</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row mb-4">
                <div class="col-5"><img style="width: 100%; height: 60px;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-7">
                    <a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a>
                    <br>
                    <span class="font-13">Dziennik Bałtycki</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="row">
                <div class="col-5"><img style="width: 100%; height: 60px;" src='{{ asset("images/for_owners/icon.png") }}'></div>
                <div class="col-7">
                    <a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a>
                    <br>
                    <span class="font-13">Dziennik Bałtycki</span>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-4 h2-owners">Pomoc</h2>
    <div class="row mb-5">
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="row">
                <div class="col-12"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="row">
                <div class="col-12"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="row">
                <div class="col-12"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="row">
                <div class="col-12"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 mb-1">
            <div class="row">
                <div class="col-12"><a href="#" class="font-16 font-m-13">Tytuł artykułu lorem ipsum</a></div>
            </div>
        </div>
    </div>

    <div class="row desktop-none" style="margin-bottom: 28px">
        <div style="width:100%; min-height: 125px; background-color: #cfcfcf; border: 1px solid black; width: 408px; padding: 16px 20px">
            <h4 style="font-size: 18px; font-weight: bold; margin-bottom: 15px">Masz pytania? Skontaktuj się z nami</h4>
            <div class="mr-2" style="float: left"><img src='{{ asset("images/for_owners/icon2.png") }}'></div>
            <span class="font-13 bold" style="display: inline-block">tel: +22 111 11 11, 600-000-000</span>
            <span class="font-13" style="display: inline-block;">pn-pt, 8:00-18:00</span>
            <div style="clear: both"></div>
            <button class="btn btn-black mt-4" style="width: 208px">Napisz do nas</button>
        </div>
    </div>
</div>
@endsection