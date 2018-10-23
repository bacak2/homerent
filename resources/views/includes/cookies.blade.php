<script>
    function cookiesAccepted(){
        $.ajax({
            type: "GET",
            url: '{{route('aboutUs.acceptCookies')}}',
            success: function(data) {
                $("#bg-footer-privace-policy").hide();
            },
            error: function() {
                console.log( "Error in connection with controller");
            },
        });
    }
</script>