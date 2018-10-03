@extends ('layout.layout')

@section('title', __('messages.My account') )

@section('content')
<span  ng-app="AccountsList" ng-controller="myCtrl">
    <div class="container mb-4">
        <div class="row mt-4 mx-0"><h1 style="font-size: 28px"><b>{{__('messages.My data')}}</b></h1></div>
        <div class="row mt-2 mx-0"><h2 style="font-size: 22px"><b>{{__('messages.Data to reservation')}}</b></h2></div>

        <div id="data-content" class="row" style="display: none">
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4" ng-repeat="account in Accounts">
                <div class="data-item-top p-2">
                    <% account.label %>
                    <div class="pull-right ml-2 delete" ng-click="deletePop(account.id)"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Delete data')}}" alt="{{__('messages.Delete data')}}" src='{{ asset("images/account/trash.png") }}'></div>
                    <div class="pull-right edit" ng-click="editItem(account)"><img data-toggle="tooltip" data-placement="bottom" title="{{__('messages.Edit data')}}" alt="{{__('messages.Edit data')}}" src='{{ asset("images/account/pencil.png") }}'></div>
                </div>
                <div class="data-item p-2">
                        <div class="mb-2" style="color: gray"><% account.title %></div>
                        <div><% account.name %> <% account.surname %></div>
                        <div><% account.address %></div>
                        <div><% account.postcode %> <% account.place %></div>
                        <div class="mb-2"><% account.country %></div>

                        <div ng-switch="account.invoice">
                            <div ng-switch-when="1">
                                <div>Faktura na:</div>
                                <div><% account.name_invoice %></div>
                                <div><% account.address_invoice %></div>
                                <div><% account.postcode_invoice %> <% account.place_invoice %></div>
                            </div>
                        </div>

                        <div class="mt-2"><% account.phone %></div>
                        <div><% account.email %></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="data-item" id="data-item-new">
                    <button id="addNew" class="btn btn-default" style="font-size: 18px">+ {{__('messages.add new')}}</button>
                </div>
            </div>
        </div>
        <div class="row mt-4 mx-0"><h3><b>{{__('messages.Account data')}}</b></h3></div>
        <div class="row">
            <div class="col-4">
                {{__('messages.Email address')}}/login:
            </div>
            <div class="col-8">
                {{ Auth::user()->email }}
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-4">
                {{__('messages.Connection with')}} Facebook:
            </div>
            <div class="col-8">
            @if(Auth::user()->facebook_id == null) {{__('messages.no')}} <a href="#" class="fb-login-button ml-4 font-13" data-max-rows="1" data-size="small" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkConnectionWithFb();">{{__('messages.Connect')}}</a>
                @else {{__('messages.yes')}}
                @endif
                <div class="font-11">{{__('messages.fbAccountExp')}}</div>
            </div>
        </div>
    </div>
<div class="add-new-data" style="display: none">
    <h4 class="p-3 mb-4"><b>{{__('messages.Add data to reservation')}}</b></h4>
    <div id="form-account" class="row mb-lg-3">
        <div class="col-md-6 col-sm-12 pl-md-5 form-full-width">
            {!! Form::open(['url' => '/foo', 'name' => 'formName', 'class' => 'pl-lg-5']) !!}
            {!! Form::hidden('id', '0', ['id'=>'id', 'ng-model' => 'id']) !!}
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('label', '', ['id'=>'label', 'class' => 'required full-width ', 'ng-model' => "label", 'placeholder' => __('messages.Designation')]) !!}
                    <span id="errlabel" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('name', '', ['id'=>'name', 'class' => 'required full-width ', 'ng-model' => "name", 'placeholder' => __('messages.Name')]) !!}
                    <span id="errname" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('surname', '', ['id'=>'surname', 'class' => 'required full-width', 'ng-model' => "surname", 'placeholder' => __('messages.Surname')]) !!}
                    <span id="errsurname" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('address', '', ['id'=>'address', 'class' => 'required full-width', 'ng-model' => "address", 'placeholder' => __('messages.StreetAndNumber')]) !!}
                    <span id="erraddress" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('postcode', '', ['id'=>'postcode', 'class' => 'required full-width', 'ng-model' => "postcode", 'placeholder' => __('messages.Postcode')]) !!}
                    <span id="errpostcode" class="error">{{__('messages.Enter valid postcode')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('place', '', ['id'=>'place', 'class' => 'required full-width', 'ng-model' => "place", 'placeholder' => __('messages.City')]) !!}
                    <span id="errplace" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('email', '', ['id'=>'email', 'class' => 'required full-width', 'ng-model' => "email", 'placeholder' => __('Email')]) !!}
                    <span id="erremail" class="error">{{__('messages.Enter valid email address')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('phone', '', ['id'=>'phone', 'class' => 'required full-width', 'ng-model' => "phone", 'placeholder' => __('messages.Cellphone')]) !!}
                    <span id="errphone" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row mx-0">
                <div class="offset-sm-3">
                    <input type="checkbox" name="otherDataForInvoice" id="otherDataForInvoice">
                </div>
                {!! Form::label('otherDataForInvoice', __('messages.Other data for invoice'), ['style'=>'font-size: 12px']) !!}
            </div>
        </div>
        <div id="invoice-block" class="col-md-6 col-sm-12 pr-md-5 form-full-width">
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('name_invoice', '', ['id'=>'name_invoice', 'class' => 'required full-width', 'ng-model' => "name_invoice", 'placeholder' => __('messages.Name')]) !!}
                    <span id="errname_invoice" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('surname_invoice', '', ['id'=>'surname_invoice', 'class' => 'required full-width', 'ng-model' => "surname_invoice", 'placeholder' => __('messages.Surname')]) !!}
                    <span id="errsurname_invoice" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('address_invoice', '', ['id'=>'address_invoice', 'class' => 'required full-width', 'ng-model' => "address_invoice", 'placeholder' => __('messages.StreetAndNumber')]) !!}
                    <span id="erraddress_invoice" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('postcode_invoice', '', ['id'=>'postcode_invoice', 'class' => 'required full-width', 'ng-model' => "postcode_invoice", 'placeholder' => __('messages.Postcode')]) !!}
                    <span id="errpostcodeInvoice" class="error">{{__('messages.Enter valid postcode')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    {!! Form::text('place_invoice', '', ['id'=>'place_invoice', 'class' => 'required full-width', 'ng-model' => "place_invoice", 'placeholder' => __('messages.City')]) !!}
                    <span id="errplace_invoice" class="error">{{__('messages.Fill this field')}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-2 col-lg-4"></div>
            <div class="col-4 col-lg-2">
                <div class="btn" id="cancel" style="font-size: 18px">{{__('messages.Cancel')}}</div>
            </div>
            <div class="col-4">
                <div class="btn btn-black" id="save" ng-click="saveItem()" style="width: 100%; font-size: 18px">{{__('messages.Save')}}</div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<div id="data-added" style="display: none">
    <h4 class="p-3"><b>{{__('messages.The data has been saved')}}</b></h4>
    <div class="px-3">{{__('messages.New data is now available in the system')}}</div>
    <div class="col-12 mb-4 mt-2">
        <div class="btn btn-black" id="cancel-data-added" style="width: 100%; font-size: 18px">{{__('messages.Close')}}</div>
    </div>
</div>

<div id="confirm-delete-pop" style="display: none">
    <h4 class="p-3"><b>{{__('messages.Are you sure you want to delete the data?')}}</b></h4>
    <div class="px-3">{{__('messages.The operation is irreversible')}}</div>
    <div class="col-12 mb-4 mt-2">
        <div class="btn btn-black" id="confirm-delete" ng-click="deleteItem(toDelete)" style="width: 100%; font-size: 18px">{{__('messages.Confirm')}}</div>
        <div class="btn" id="cancel-delete" style="width: 100%; font-size: 18px">{{__('messages.Cancel')}}</div>
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
                if ($('#otherDataForInvoice:checkbox:checked').length > 0) invoice = 1;
                else invoice = 0;

                if(valid() == false) return false;
                $.ajax({
                    type: "GET",
                    url: '/account/save',
                    dataType : 'json',
                    data: {
                        id: $("#id").val(),
                        label: $("#label").val(),
                        name: $("#name").val(),
                        surname: $("#surname").val(),
                        address: $("#address").val(),
                        postcode: $("#postcode").val(),
                        place: $("#place").val(),
                        name_invoice: $("#name_invoice").val(),
                        surname_invoice: $("#surname_invoice").val(),
                        address_invoice: $("#address_invoice").val(),
                        postcode_invoice: $("#postcode_invoice").val(),
                        place_invoice: $("#place_invoice").val(),
                        phone: $("#phone").val(),
                        email: $("#email").val(),
                        invoice: invoice,
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
                $('#label').val(object.label);
                $('#name').val(object.name);
                $('#surname').val(object.surname);
                $('#address').val(object.address);
                $('#postcode').val(object.postcode);
                $('#place').val(object.place);
                $('#name_invoice').val(object.name_invoice);
                $('#surname_invoice').val(object.surname_invoice);
                $('#address_invoice').val(object.address_invoice);
                $('#postcode_invoice').val(object.postcode_invoice);
                $('#place_invoice').val(object.place_invoice);
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

        function valid(){
            checkValidation();
            if($('#otherDataForInvoice').is(":checked")) checkInvoiceValidation();
            var name = $('#name');
            var surname = $('#surname');
            var address = $('#address');
            var postcode = $('#postcode');
            var place = $('#place');
            var email = $('#email');
            var phone = $('#phone');

            var postcodeInvoice = $('#postcode_invoice');

            if(name.hasClass('valid') && surname.hasClass('valid') && address.hasClass('valid') && postcode.hasClass('valid') && place.hasClass('valid') && email.hasClass('valid') && phone.hasClass('valid')){
                if($('#otherDataForInvoice').is(":checked")){
                    if(postcodeInvoice.hasClass('valid')){
                        return true;
                    }
                    else return false;
                }
                else return true;
            }
            else {
                return false;
            }
        }

    </script>
<script>
    $("#addNew").on('click', function(){
        $("div.add-new-data").css({'display': 'block'});
        $('input').val('');
        $('input#name').val('{{Auth::user()->name}}');
        $('input#surname').val('{{Auth::user()->surname}}');
        $('input#email').val('{{Auth::user()->email}}');
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

    $("#otherDataForInvoice").on('click', function(){
        if ($('#otherDataForInvoice:checkbox:checked').length > 0) {
            $("#invoice-block").css({'display': 'block'});
        }
        else{

            $("#invoice-block").css({'display': 'none'});
        }
    });


    $(document).ready(function(){
        $("#data-content").css('display', 'flex');

        if ($('#otherDataForInvoice:checkbox:checked').length > 0) {
            $("#invoice-block").css({'display': 'block'});
        }
        else{

            $("#invoice-block").css({'display': 'none'});
        }
    });

</script>

<script>
    $(document).ready(function() {

        //Walidacja pól, które nie mogą być puste
        $('#label, #name, #surname, #address, #place, #phone, #name_invoice, #surname_invoice, #address_invoice, #place_invoice').on('blur', function() {
            var name = $(this).attr('id');
            if($(this).val().length > 0){
                $(this).removeClass("invalid").addClass("valid");
                $('#err'+name).removeClass("error-show");
            }
            else{
                $(this).removeClass("valid").addClass("invalid");
                $('#err'+name).addClass("error-show");
            }
        });

        //Walidacja kodu pocztowego
        $('#postcode').on('blur', function() {
            var pattern = /^[0-9]{2}-[0-9]{3}$/i;
            if(pattern.test($(this).val())){
                $(this).removeClass("invalid").addClass("valid");
                $('#errpostcode').removeClass("error-show");
            }
            else{
                $(this).removeClass("valid").addClass("invalid");
                $('#errpostcode').addClass("error-show");
            }
        });

        //Walidacja email
        $('#email').on('blur', function() {
            var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if(pattern.test($(this).val())){
                $(this).removeClass("invalid").addClass("valid");
                $('#erremail').removeClass("error-show");
            }
            else{
                $(this).removeClass("valid").addClass("invalid");
                $('#erremail').addClass("error-show");
            }
        });

        //Walidacja kodu pocztowego w fakturze
        $('#postcode_invoice').on('blur', function() {
            var pattern = /^[0-9]{2}-[0-9]{3}$/i;
            if(pattern.test($(this).val())){
                $(this).removeClass("invalid").addClass("valid");
                $('#errpostcodeInvoice').removeClass("error-show");
            }
            else{
                $(this).removeClass("valid").addClass("invalid");
                $('#errpostcodeInvoice').addClass("error-show");
            }
        });

    });

    function checkValidation(){

        var label = $('#label');
        var name = $('#name');
        var surname = $('#surname');
        var address = $('#address');
        var place = $('#place');
        var postcode = $('#postcode');
        var email = $('#email');
        var phone = $('#phone');

        if(label.val().length > 0){
            label.removeClass("invalid").addClass("valid");
            $('#errlabel').removeClass("error-show");
        }
        else{
            name.removeClass("valid").addClass("invalid");
            $('#errlabel').addClass("error-show");
        }

        if(name.val().length > 0){
            name.removeClass("invalid").addClass("valid");
            $('#errname').removeClass("error-show");
        }
        else{
            name.removeClass("valid").addClass("invalid");
            $('#errname').addClass("error-show");
        }

        if(surname.val().length > 0){
            surname.removeClass("invalid").addClass("valid");
            $('#errsurname').removeClass("error-show");
        }
        else{
            name.removeClass("valid").addClass("invalid");
            $('#errsurname').addClass("error-show");
        }

        if(address.val().length > 0){
            address.removeClass("invalid").addClass("valid");
            $('#erraddress').removeClass("error-show");
        }
        else{
            address.removeClass("valid").addClass("invalid");
            $('#erraddress').addClass("error-show");
        }

        if(place.val().length > 0){
            place.removeClass("invalid").addClass("valid");
            $('#errplace').removeClass("error-show");
        }
        else{
            place.removeClass("valid").addClass("invalid");
            $('#errplace').addClass("error-show");
        }

        if(phone.val().length > 0){
            phone.removeClass("invalid").addClass("valid");
            $('#errphone').removeClass("error-show");
        }
        else{
            phone.removeClass("valid").addClass("invalid");
            $('#errphone').addClass("error-show");
        }

        var patternPostcode = /^[0-9]{2}-[0-9]{3}$/i;
        if(patternPostcode.test(postcode.val())){
            postcode.removeClass("invalid").addClass("valid");
            $('#errpostcode').removeClass("error-show");
        }
        else{
            email.removeClass("valid").addClass("invalid");
            $('#errpostcode').addClass("error-show");
        }

        var patternEmail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if(patternEmail.test(email.val())){
            email.removeClass("invalid").addClass("valid");
            $('#erremail').removeClass("error-show");
        }
        else{
            email.removeClass("valid").addClass("invalid");
            $('#erremail').addClass("error-show");
        }
    }

    function checkInvoiceValidation(){

        var name_invoice = $('#name_invoice');
        var surname_invoice = $('#surname_invoice');
        var address_invoice = $('#address_invoice');
        var postcodeInvoice = $('#postcode_invoice');
        var place_invoice = $('#place_invoice');

        var patternPostcodeInvoice = /^[0-9]{2}-[0-9]{3}$/i;
        if(patternPostcodeInvoice.test(postcodeInvoice.val())){
            postcodeInvoice.removeClass("invalid").addClass("valid");
            $('#errpostcodeInvoice').removeClass("error-show");
        }
        else{
            postcodeInvoice.removeClass("valid").addClass("invalid");
            $('#errpostcodeInvoice').addClass("error-show");
        }

        if(name_invoice.val().length > 0){
            name_invoice.removeClass("invalid").addClass("valid");
            $('#errname_invoice').removeClass("error-show");
        }
        else{
            name_invoice.removeClass("valid").addClass("invalid");
            $('#errname_invoice').addClass("error-show");
        }

        if(surname_invoice.val().length > 0){
            surname_invoice.removeClass("invalid").addClass("valid");
            $('#errsurname_invoice').removeClass("error-show");
        }
        else{
            name_invoice.removeClass("valid").addClass("invalid");
            $('#errsurname_invoice').addClass("error-show");
        }

        if(address_invoice.val().length > 0){
            address_invoice.removeClass("invalid").addClass("valid");
            $('#erraddress_invoice').removeClass("error-show");
        }
        else{
            address_invoice.removeClass("valid").addClass("invalid");
            $('#erraddress_invoice').addClass("error-show");
        }

        if(place_invoice.val().length > 0){
            place_invoice.removeClass("invalid").addClass("valid");
            $('#errplace_invoice').removeClass("error-show");
        }
        else{
            place_invoice.removeClass("valid").addClass("invalid");
            $('#errplace_invoice').addClass("error-show");
        }


    }
</script>

<script>
    function checkConnectionWithFb(){
        FB.getLoginStatus(function(response) {
            if(response.status == "connected"){

                //wprowadź do BD facebook_id dla tego usera (ajax-> newConnectionFb)
                $.ajax({
                    type: "GET",
                    url: '/account/new-connection-fb',
                    dataType : 'json',
                    data: {
                        userID: response.authResponse.userID,
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function() {
                        console.log("Error in connection with controller");
                    },
                });

            }
            else alert("{{__('messages.FbConnectionError')}}");
        });
    }
</script>
@endsection