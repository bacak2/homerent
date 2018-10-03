@extends ('pages.results')
@section('title', __('messages.My favourites'))

@section ('displayResults')

    <div class="row desktop-none mobile-none" style="margin-bottom: 20px">
        <div class="col-9 text-mobile-search">
        </div>
        <div class="col-3">
            <div  style="position: absolute; right:10px;"><a  class="btn btn-info btn-mobile filters-toggle">{{__('messages.change')}} </a></div>
        </div>

    </div>

    <div>
        <div class="row">
            <div class="col-12 col-md-6"><h1 style="font-size: 32px" class="pb-2 bold">{{__('messages.My favourites')}} ({{ $favouritesCount }})</h1></div>
            <div class="col-12 col-md-6 font-13 txt-blue mb-2 mb-md-0">
                @mobile
                    <span class="send-to-friends"><img style="width: 18px; margin-right: 8px" src="{{asset('images/favourites/Envelop.png')}}">{{__('messages.Send to friend')}}</span>
                    <span class="mx-2" style="color:#CCCCCC;">|</span>
                    <span id="clear-favourites" class=""><img style="width: 18px; margin-right: 8px" src="{{asset('images/favourites/Trash_Can.png')}}">{{__('messages.Clear favourites')}}</span>
                @elsemobile
                    <span id="clear-favourites" class="pull-right"><img style="width: 18px; margin-right: 8px" src="{{asset('images/favourites/Trash_Can.png')}}">{{__('messages.Clear favourites')}}</span>
                    <span class="pull-right mx-2" style="color:#CCCCCC;">|</span>
                    <span class="send-to-friends pull-right"><img style="width: 18px; margin-right: 8px" src="{{asset('images/favourites/Envelop.png')}}">{{__('messages.Send to friend')}}</span>
                @endmobile
            </div>
        </div>
        <div id="eneterTermRow" class="row mb-4" @if($request->has('t-start')) style="display: none" @endif>
            <div class="col-12" >
                <div>
                <div style="padding: 10px; background-color: rgba(228, 228, 228, 1); min-height: 70px;">
                    <div class="d-inline-block pull-left mr-2">
                        <i class="fa fa-3x fa-info-circle"></i>
                    </div>
                    <div class="font-12 d-inline">{{__('messages.IfYouWant')}}</div>
                    <div id="enterTerm" class="mt-2 mt-md-0 px-4 text-center">{{__('messages.Enter')}}<br>{{__('messages.term')}}</div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            @desktop
            <div class="col-3 col-md-2 col-lg-1 bold" style="font-size: 24px">@yield('fav-title')</div>
            @if(!Request::is('*/my-favourites-compare*') && !Request::is('*/my-favourites-map*'))
                <div class="col-9 col-md-5 col-lg-6">
                    <div class="mt-1 font-13">{{__('messages.Sort by')}}:
                        @if(isset($_GET['t-start']))
                            {{ Form::select('sort', $sortSelectArray, $request->sort ?? 1, array('class'=>'input-sm', 'id'=>'u1001_input', 'onchange'=>'submitSort()'))}}
                            </form>
                        @else
                            </form>
                            <form id="onlySort" action="{{$request->getPathInfo()}}" class="d-inline" method="GET">
                                {{ Form::select('sort', $sortSelectArray, $request->sort ?? 1, array('class'=>'input-sm', 'id'=>'u1001_input', 'onchange'=>'submitSort()'))}}
                            </form>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 inline-wrapper text-right">
                    @yield('icons-active')
                </div>
            @else
                <div class="col-9 col-md-10 col-lg-11 inline-wrapper text-right">
                    @yield('icons-active')
                </div>
                </form>
            @endif
            @elsedesktop
                @if(!Request::is('*/my-favourites-compare*') && !Request::is('*/my-favourites-map*'))
                    <div class="col-sm-6">
                        <div class="mt-1 font-13">{{__('messages.Sort by')}}:
                            {{ Form::select('sort', $sortSelectArray, $request->sort ?? 1, array('class'=>'input-sm', 'id'=>'u1001_input', 'onchange'=>'submitSort()'))}}
                            </form>
                        </div>
                    </div>
                @else
                    </form>
                @endif
                @yield('icons-active-mobile')
            @enddesktop
        </div>
    </div>
    @yield('if-has-przyjazd')

    @yield('compare-content')

    @yield('script')
    <script>
    $("#enterTerm").on('click', function(){
        $("div.results-search").show();
        $("#eneterTermRow").hide();
    });

    $("#wyszukiwarka").submit(function( event ) {
        var getDates = $('.t-datepicker').tDatePicker('getDates')
        if(getDates[0] == null){
            event.preventDefault();
            alert("{{__('messages.Please select the date of your stay')}}");
        }
    });

    function submitSort(){
        if($("#u1001_input").val() == 5){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        $('<input>').attr('type', 'hidden')
                            .attr('name', "latitude")
                            .attr('value', position.coords.latitude)
                            @if(isset($_GET['t-start'])) .appendTo('#wyszukiwarka');
                            @else .appendTo('#onlySort');
                            @endif

                        $('<input>').attr('type', 'hidden')
                            .attr('name', "longitude")
                            .attr('value', position.coords.longitude)
                            @if(isset($_GET['t-start'])) .appendTo('#wyszukiwarka');
                            @else .appendTo('#onlySort');
                            @endif

                        @if(isset($_GET['t-start'])) $("#wyszukiwarka").submit();
                        @else $("#onlySort").submit();
                        @endif
                    }
                );
            }else{
                alert("{{__('messages.GeoNotSupported')}}");
                return false;
            }
        }
        else
        @if(isset($_GET['t-start'])) $("#wyszukiwarka").submit();
        @else $("#onlySort").submit();
        @endif
    }
    </script>

@endsection