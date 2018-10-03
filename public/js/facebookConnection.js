window.fbAsyncInit = function() {
    FB.init({
        appId      : '261522604441330',
        cookie     : true,
        xfbml      : true,
        version    : 'v3.1'
    });

    FB.AppEvents.logPageView();
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/"+localeLanguage+"_"+localeLanguage.toUpperCase()+"/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkLoginState(){
    FB.getLoginStatus(function(response) {
        if(response.status == "connected"){

            //zaloguj na podstawie userID
            $.ajax({
                type: "GET",
                url: '/log-via-fb',
                dataType : 'json',
                data: {
                    userID: response.authResponse.userID,
                },
                success: function(data) {
                    if(data.response == 'true') location.reload();
                    else if(localeLanguage == 'en') alert("This Facebook account is not linked to any Otozakopane account");
                    else alert("To konto Facebook nie jest połączone z żadnym kontem Otozakopane");
                },
                error: function() {
                    console.log("Error in connection with controller");
                },
            });

        }
        else if(localeLanguage == 'en') alert("There was an error connecting to Facebook");
        else alert("Wystąpił błąd podczas połączenia z Facebookiem");
    });
}

function registerViaFb(){

    FB.getLoginStatus(function(response) {
        if(response.status == "connected") {
            var userId = response.authResponse.userID;
            //get users data
            FB.api("/"+userId+"/", {
                locale: localeLanguage+'_'+localeLanguage.toUpperCase(),
                fields: 'last_name, first_name, email'
                },

                function(response) {
                    //zarejestruj na podstawie danych z fb
                    $.ajax({
                        type: "GET",
                        url: '/register-via-fb',
                        dataType : 'json',
                        data: {
                            userID: response.id,
                            email: response.email,
                            first_name: response.first_name,
                            last_name: response.last_name,
                        },
                        success: function(response) {
                            alert(response.message);
                        },
                        error: function() {
                            console.log("Error in connection with controller");
                        },
                    });
                }
            );
        }
        else if(localeLanguage == 'en') alert("There was an error connecting to Facebook");
        else alert("Wystąpił błąd podczas połączenia z Facebookiem");
    });
}