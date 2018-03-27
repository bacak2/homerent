@extends ('layout.layout')

@section('title', '- '.Auth::user()->name.'- '.__('messages.My account') )

@section('content')
    <div class="container">
        <div class="row mt-4"><h3><b>Moje dane</b></h3></div>
        <div class="row mt-2"><h4><b>Dane do rezerwacji</b></h4></div>
        <div class="row">
            @foreach(json_decode($users_account) as $item)
            <div class="col-lg-3 col-sm-12 mb-4">
                <div class="data-item-top p-2">
                    {{ $item->name." ".$item->surname }}
                    <div id="{{$item->id}}" class="pull-right ml-2 delete"><img src='{{ asset("images/account/trash.png") }}'></div>
                    <div id="{{$item->id}}" class="pull-right edit"><img src='{{ asset("images/account/pencil.png") }}'></div>
                </div>
                <div class="data-item p-2">
                    item
                </div>
            </div>
            @endforeach
            <div class="col-lg-3 col-sm-12">
                <div class="data-item" id="data-item-new">
                    <button id="addNew" style="font-size: 18px">+ dodaj nowe</button>
                </div>
            </div>

        </div>
        <div class="row mt-4"><h4><b>Dane konta</b></h4></div>
        <div class="row">
            <div class="col-4">
                Adres e-mail/login:
            </div>
            <div class="col-8">
                {{ Auth::user()->email }}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
                Połączenie z Facebook:
            </div>
            <div class="col-8">
                nie
            </div>
        </div>
    </div>
<div class="add-new-data" style="display: none">
    Dodaj dane do rezerwacji
    <div class="col-lg-7 col-sm-12 pl-lg-5 form-full-width">
        {!! Form::open(['url' => '/foo']) !!}
        <div class="form-group row">
            {{ Form::label('title', __('messages.Title'), array('class' => 'col-sm-3 col-form-label')) }}
            <div class="col-sm-9">
                {!! Form::select('title', array('M' => __('messages.Mr'), 'F' => __('messages.Mrs'))) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('name', __('messages.Name'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('name', '', ['class' => 'required']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('surname', __('messages.Surname'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('surname', '', ['class' => 'required']) !!}
            </div>
        </div>
        <!--div class="form-group row">
            {!! Form::label('country', __('messages.Country'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::select('country', array('Polska' => __('Polska'), 'Niemcy' => __('Niemcy')), 'Polska', array('class' => 'col-sm-12 col-lg-3')) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('address', __('messages.Address'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('address', '', ['class' => 'required']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('postcode', __('messages.Postcode'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('postcode', '', array('class' => 'not-full-with col-sm-12 col-lg-6')) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('place', __('messages.Place'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('place', '', ['class' => 'required']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('phone', __('messages.Cellphone number'), array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('phone') !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('email', 'E-mail', array('class' => 'col-sm-3 col-form-label')) !!}
            <div class="col-sm-9">
                {!! Form::text('email', '', ['class' => 'required']) !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-3">
                {!! Form::checkbox('wantInvoice') !!}
            </div>
            {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 12px']) !!}
        </div-->
        <div class="form-group row">
            <div class="col-6">
                <div id="cancel" style="font-size: 18px">Anuluj</div>
            </div>
            <div class="col-6">
                <div id="save" style="font-size: 18px">Zapisz</div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

</div>
<script>
    $("#addNew").on('click', function(){
        $("div.add-new-data").css({'display': 'block'});
    });

    $("#cancel").on('click', function(){
        $("div.add-new-data").css({'display': 'none'});
    });

    $("#save").on('click', function(){
        addNewItem();
    });

    $(".edit").on('click', function(){
        editItem($(this).attr('id'));
    });

    $(".delete").on('click', function(){
        deleteItem($(this).attr('id'));
    });

    function addNewItem(){

        var name = $("#name");
        var email = '{{ Auth::user()->email }}';

        $.ajax({
            type: "GET",
            url: '/account/add',
            dataType : 'json',
            data: {
                name: name.val(),
                email: email,
            },
            success: function(data) {
                console.log(data);
            },
            error: function() {
                console.log("Error in connection with controller");
            },
        });

        refreshView();
    }

    function editItem(id){

        var email = '{{ Auth::user()->email }}';

        $.ajax({
            type: "GET",
            url: `/account/edit/${id}`,
            dataType : 'json',
            data: {
                email: email,
            },
            success: function(data) {
                $('#name').val(data[0]['name']);
                $('#surname').val(data[0]['surname']);
                $("div.add-new-data").css({'display': 'block'});
            },
            error: function() {
                console.log("Error in connection with controller");
            },
        });

        refreshView();
    }

    function deleteItem(id){

        var email = '{{ Auth::user()->email }}';

        $.ajax({
            type: "GET",
            url: `/account/delete/${id}`,
            dataType : 'json',
            data: {
                email: email,
            },
            success: function(data) {
                console.log(data);
            },
            error: function() {
                console.log("Error in connection with controller");
            },
        });

        refreshView();
    }

    function refreshView(){

        var email = '{{ Auth::user()->email }}';

        $.ajax({
            type: "GET",
            url: '/account/refreshView',
            dataType : 'json',
            data: {
                email: email,
            },
            success: function(data) {
                console.log(data);
                $.each(data, function (i) {
                    $.each(data[i], function (key, val) {
                        /*$('#foreach').html(`
                        <div class="data-item-top p-2">
                                ${data['name']}+" "+${data['surname']}
                            <div id="${data['id']}" class="pull-right ml-2 delete"></div>
                            <div id="${data['id']}" class="pull-right edit"></div>
                        </div>
                            <div class="data-item p-2">
                                item
                            </div>
                        </div>
                        `);
                        */
                    });
                });
            },
            error: function() {
                console.log("Error in connection with controller");
            },
        });

        //window.location.reload(true);

    }
</script>
@endsection