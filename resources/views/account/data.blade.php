@extends ('layout.layout')

@section('title', '- '.Auth::user()->name.'- '.__('messages.My account') )

@section('content')
<span  ng-app="AccountsList" ng-controller="myCtrl">
    <div class="container">
        <div class="row mt-4"><h3><b>Moje dane</b></h3></div>
        <div class="row mt-2"><h4><b>Dane do rezerwacji</b></h4></div>

        <div id="data-content" class="row" style="display: none">
            <div class="col-lg-3 col-sm-12 mb-4" ng-repeat="account in Accounts">
                <div class="data-item-top p-2">
                    <% account.label %>
                    <div class="pull-right ml-2 delete" ng-click="deletePop(account.id)"><img src='{{ asset("images/account/trash.png") }}'></div>
                    <div class="pull-right edit" ng-click="editItem(account)"><img src='{{ asset("images/account/pencil.png") }}'></div>
                </div>
                <div class="data-item p-2">
                        <div class="mb-2"><% account.title %></div>
                        <div><% account.name %> <% account.surname %></div>
                        <div><% account.address %></div>
                        <div><% account.postcode %> <% account.place %></div>
                        <div class="mb-2"><% account.country %></div>
                        <div>Faktura na:</div>
                        <div><% account.name %> <% account.surname %></div>
                        <div><% account.address %></div>
                        <div><% account.postcode %> <% account.place %></div>
                        <div class="mt-2"><% account.phone %></div>
                        <div><% account.email %></div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
                <div class="data-item" id="data-item-new">
                    <button id="addNew" class="btn btn-default" style="font-size: 18px">+ dodaj nowe</button>
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
    <h4 class="p-3 mb-4"><b>Dodaj dane do rezerwacji</b></h4>
    <div class="row mb-lg-3">
        <div class="col-lg-6 col-sm-12 pl-lg-5 form-full-width">
            {!! Form::open(['url' => '/foo', 'name' => 'formName', 'class' => 'pl-5']) !!}
            {!! Form::hidden('id', '0', ['id'=>'id', 'ng-model' => 'id']) !!}
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('name', '', ['id'=>'name', 'class' => 'required', 'ng-model' => "name", 'placeholder' => __('messages.Name')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('surname', '', ['id'=>'surname', 'class' => 'required', 'ng-model' => "surname", 'placeholder' => __('messages.Surname')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('address', '', ['id'=>'address', 'class' => 'required', 'ng-model' => "address", 'placeholder' => __('messages.Address')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('postcode', '', ['id'=>'postcode', 'class' => 'required', 'ng-model' => "postcode", 'placeholder' => __('messages.Postcode')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('place', '', ['id'=>'place', 'class' => 'required', 'ng-model' => "place", 'placeholder' => __('messages.Place')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('email', '', ['id'=>'email', 'class' => 'required', 'ng-model' => "email", 'placeholder' => __('Email')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('phone', '', ['id'=>'phone', 'class' => 'required', 'ng-model' => "phone", 'placeholder' => __('messages.Cellphone')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-3">
                    {!! Form::checkbox('wantInvoice') !!}
                </div>
                {!! Form::label('wantInvoice', __('messages.wantInvoice'), ['style'=>'font-size: 12px']) !!}
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 pr-lg-5 form-full-width">
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('name', '', ['class' => 'required', 'ng-model' => "name", 'placeholder' => __('messages.Name')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('surname', '', ['class' => 'required', 'ng-model' => "surname", 'placeholder' => __('messages.Surname')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('address', '', ['class' => 'required', 'ng-model' => "surname", 'placeholder' => __('messages.Address')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('postcode', '', ['class' => 'required', 'ng-model' => "surname", 'placeholder' => __('messages.Postcode')]) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                    {!! Form::text('place', '', ['class' => 'required', 'ng-model' => "surname", 'placeholder' => __('messages.Place')]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group row">
            <div class="col-2 col-lg-4"></div>
            <div class="col-4 col-lg-2">
                <div class="btn" id="cancel" style="font-size: 18px">Anuluj</div>
            </div>
            <div class="col-4">
                <div class="btn btn-black" id="save" ng-click="saveItem()" style="width: 100%; font-size: 18px">Zapisz</div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div id="data-added" style="display: none">
    <h4 class="p-3"><b>Dane zostały zapisane</b></h4>
    <div class="px-3">Nowe dane są od teraz dostępne w systemie</div>
    <div class="col-12 mb-4 mt-2">
        <div class="btn btn-black" id="cancel-data-added" style="width: 100%; font-size: 18px">Zamknij</div>
    </div>
</div>

<div id="confirm-delete-pop" style="display: none">
    <h4 class="p-3"><b>Czy na pewno chcesz usunąć element?</b></h4>
    <div class="px-3">Operacja jest nieodwracalna</div>
    <div class="col-12 mb-4 mt-2">
        <div class="btn btn-black" id="confirm-delete" ng-click="deleteItem(toDelete)" style="width: 100%; font-size: 18px">Potwierdź</div>
        <div class="btn" id="cancel-delete" style="width: 100%; font-size: 18px">Anuluj</div>
    </div>
</div>
</span>

<script>
        users_account = '<?php echo $users_account ?>';
        accounts = JSON.parse(users_account);
        email = '{{ Auth::user()->email }}';

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script>
        var app = angular.module("AccountsList", [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

        app.controller("myCtrl", function($scope, $http) {
            $scope.Accounts = accounts
            $scope.toDelete = ''
            $scope.saveItem = function() {
                $.ajax({
                    type: "GET",
                    url: '/account/save',
                    dataType : 'json',
                    data: {
                        id: $("#id").val(),
                        name: $("#name").val(),
                        surname: $("#surname").val(),
                        address: $("#address").val(),
                        postcode: $("#postcode").val(),
                        place: $("#place").val(),
                        phone: $("#phone").val(),
                        email: $("#email").val(),
                        user_email: email,
                    },
                    success: function(data) {
                        console.log(data);
                        $scope.refreshView();
                        $("div.add-new-data").css({'display': 'none'});
                        $("div#data-added").css({'display': 'block'});
                        $scope.formData = {};
                        $scope.formName.$setPristine();
                    },
                    error: function() {
                        console.log("Error in connection with controller");
                    },
                });
            }

            $scope.editItem = function(object) {
                $('#id').val(object.id);
                $('#name').val(object.name);
                $('#surname').val(object.surname);
                $('#address').val(object.address);
                $('#postcode').val(object.postcode);
                $('#place').val(object.place);
                $('#email').val(object.email);
                $('#phone').val(object.phone);
                $("div.add-new-data").css({'display': 'block'});
                /*$.ajax({
                    type: "GET",
                    url: `/account/edit/${id}`,
                    dataType : 'json',
                    data: {
                        email: email,
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#id').val(data[0]['id']);
                        $scope.name = data[0]['name'];
                        $('#surname').val(data[0]['surname']);
                        $("div.add-new-data").css({'display': 'block'});
                    },
                    error: function() {
                        console.log("Error in connection with controller");
                    },
                });
        */
            }

            $scope.deleteItem = function(id) {
                console.log(id);
                $http({
                    url: `/account/delete/${id}`,
                    method: "GET",
                }).then(function successCallback() {
                    $scope.refreshView();
                    $("#confirm-delete-pop").css({'display': 'none'});
                }, function errorCallback(response) {
                    console.log(response.statusText);
                });
            }

            $scope.deletePop = function(id) {
                $scope.toDelete = id;
                $("#confirm-delete-pop").css({'display': 'block'});
            }

            $scope.refreshView = function() {
                $http({
                    url: '/account/refreshView',
                    method: "GET",
                }).then(function successCallback(response) {
                    $scope.Accounts = response.data;
                }, function errorCallback(response) {
                    console.log(response.statusText);
                });
            }

        });

    </script>
<script>
    $("#addNew").on('click', function(){
        $("div.add-new-data").css({'display': 'block'});
        $('input').val('');
    });

    $("#cancel").on('click', function(){
        $("div.add-new-data").css({'display': 'none'});
    });

    $("#cancel-delete").on('click', function(){
        $("#confirm-delete-pop").css({'display': 'none'});
    });

    $("#cancel-data-added").on('click', function(){
        $("#data-added").css({'display': 'none'});
    });

    $(document).ready(function(){
        $("#data-content").css('display', 'flex');
    });

</script>
@endsection