<!-- Footer -->
<footer class="noprint">
    <div class="pt-5 pb-3 bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <!--div class="col-12 col-md-6 mb-4 mb-md-0">
                            <div class="font-16 bold mb-2"><a href="#">Najpopularniejsze miejsca</a></div>
                            <div class="row font-13">
                                <div class="col-6">
                                    <div><a href="#">Kraków</a></div>
                                    <div><a href="#">Warszawa</a></div>
                                    <div><a href="#">Wrocław</a></div>
                                    <div><a href="#">Zakopane</a></div>
                                </div>
                                <div class="col-6">
                                    <div><a href="#">Kraków</a></div>
                                    <div><a href="#">Kraków</a></div>
                                    <div><a href="#">Kraków</a></div>
                                </div>
                            </div>
                        </div-->

                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <div class="font-16 bold mb-2"><a href="{{route('aboutUs.contact')}}">{{ __('messages.help') }}</a></div>
                            <div class="font-13"><a href="{{route('aboutUs.contact').'#faq'}}">{{ __('messages.faq') }}</a></div>
                            <div class="font-13"><a href="/guidebooks">{{ __('messages.Guidebooks') }}</a></div>
                            <div class="font-13"><a href="{{route('travelers.index')}}">{{ __('messages.For travelers') }}</a></div>
                            <div class="font-13"><a href="http://wlasciciele-visitzakopane.pl{{--route('owners.index')--}}">{{ __('messages.For owners') }}</a></div>
                        </div>
                    </div>
                    <div class="row mobile-none">
                        <div class="col-12 mt-4">
                            <div class="font-16 bold mb-2">{{ __('messages.TravelWithUs') }}</div>
                            <div class="font-13">{{ __('messages.TravelWithUs2') }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-4 mb-md-0">
                    <div class="font-16 bold mb-2"><a href="{{route('aboutUs.index')}}">{{ __('messages.aboutus') }}</a></div>
                    <div class="row font-13">
                        <div class="col-6 col-md-7">
                            <div><a href="{{route('aboutUs.index')}}">{{ __('messages.About company') }}</a></div>
                            <div><a href="{{route('aboutUs.media')}}">{{ __('Media') }}</a></div>
                            <div><a href="/privacy-policy">{{ __('messages.Privacy policy') }}</a></div>
                            <div><a href="/regulations">{{ __('messages.Regulations') }}</a></div>
                            <div><a href="{{route('aboutUs.contact')}}">{{ __('messages.Contact') }}</a></div>
                        </div>
                        <div class="col-6 col-md-5 mobile-none">
                            <div><a href="{{route('aboutUs.news')}}">{{ __('messages.News') }}</a></div>
                            <!--div><a href="#">Program afiliacyjny</a></div-->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-2">
                    <div class="font-16 bold"><a>{{ __('messages.Stay updated') }}</a></div>
                    <div class="p-2 row mx-0 no-gutters text-center" style="background-color: #ffffff">
                        <div class="col"><a href="https://www.facebook.com/VisitZakopane/"><img src="{{ asset('images/layout/Facebook_24.png') }}" alt="{{ __('facebook') }}"></a></div>
                        <div class="col"><a href="https://www.instagram.com/visitzakopane.pl/"><img src="{{ asset('images/layout/Instagram_24.png') }}" alt="{{ __('instagram') }}"></a></div>
                        <div class="col"><a href="https://twitter.com/Visit_Zakopane"><img src="{{ asset('images/layout/Twitter_24.png') }}" alt="{{ __('twitter') }}"></a></div>
                        <div class="col"><a href="https://pl.pinterest.com/visitzakopanepl/"><img src="{{ asset('images/layout/Pinterest_24.png') }}" alt="{{ __('pinterest') }}"></a></div>
                        <div class="col"><a href="https://www.youtube.com/channel/UCMvFBDolqJF1vniBeBeqERA"><img src="{{ asset('images/layout/Youtube 2_24.png') }}" alt="{{ __('youtube') }}"></a></div>
                        <div class="col"><a href="https://www.linkedin.com/company/662129/"><img src="{{ asset('images/layout/LinkedIn_24.png') }}" alt="{{ __('linkedin') }}"></a></div>
                        <!--div class="g-follow" data-annotation="bubble" data-height="20" data-href="https://plus.google.com/112646535477180334123" data-rel="publisher"></div>
                        <div class="g-ytsubscribe" data-channel="NoclegiVISITzakopane" data-layout="default" data-count="default"></div-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-4 pb-2 bg-footer-privace-policy">
        <div class="container">
            <div class="row font-11">
                <div class="col-12 col-md-8">
                    {{ __('messages.cookies') }}
                    <br>
                    {{ __('messages.cookies2') }}
                    <a class="text-white" style="text-decoration: underline" href="/privacy-policy">{{ __('messages.privacypolicy') }}</a>
                </div>
                <div class="col-4">

                </div>
            </div>
        </div>
    </div>
</footer>