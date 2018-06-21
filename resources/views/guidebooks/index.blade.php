@extends ('layout.layout')
@section('title', 'Przewodniki')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Popularne miasta</h2>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Kraków</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Lorem ipsum</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Popularne miasta</h2>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Kraków</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Lorem ipsum</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Popularne miasta</h2>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Kraków</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                    <div class="mb-3" style="position: relative">
                        <a class="to-download-description" href="{{route('aboutUs.guidebookDetail', 0)}}">
                            <img style="width:100%" src="{{asset('images/main/guidebook.png')}}">
                        </a>
                        <div class="guidebooks-top-description">Lorem ipsum</div>
                        <div class="guidebooks-bottom-description">Przewodnik</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Popularne miasta</h2>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Miejsca do wypoczynku</h2>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2-guidebooks">Inne podróże</h2>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                    <a class="d-block" href="{{route('aboutUs.guidebookDetail', 0)}}">Lorem ipsum</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection