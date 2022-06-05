(function() {
    "use strict";
    
    $("#Password-toggle a").on('click', function(event) {
        event.preventDefault();
        if ($('#Password-toggle input').attr("type") == "text") {
            $('#Password-toggle input').attr('type', 'password');
            $('#Password-toggle i').addClass("zmdi-eye");
            $('#Password-toggle i').removeClass("zmdi-eye-off");
        } else if ($('#Password-toggle input').attr("type") == "password") {
            $('#Password-toggle input').attr('type', 'text');
            $('#Password-toggle i').removeClass("zmdi-eye");
            $('#Password-toggle i').addClass("zmdi-eye-off");
        }
    });

    $("#Password-toggle1 a").on('click', function(event) {
        event.preventDefault();
        if ($('#Password-toggle1 input').attr("type") == "text") {
            $('#Password-toggle1 input').attr('type', 'password');
            $('#Password-toggle1 i').addClass("zmdi-eye");
            $('#Password-toggle1 i').removeClass("zmdi-eye-off");
        } else if ($('#Password-toggle1 input').attr("type") == "password") {
            $('#Password-toggle1 input').attr('type', 'text');
            $('#Password-toggle1 i').removeClass("zmdi-eye");
            $('#Password-toggle1 i').addClass("zmdi-eye-off");
        }
    });

    $("#Password-toggle2 a").on('click', function(event) {
        event.preventDefault();
        if ($('#Password-toggle2 input').attr("type") == "text") {
            $('#Password-toggle2 input').attr('type', 'password');
            $('#Password-toggle2 i').addClass("zmdi-eye");
            $('#Password-toggle2 i').removeClass("zmdi-eye-off");
        } else if ($('#Password-toggle2 input').attr("type") == "password") {
            $('#Password-toggle2 input').attr('type', 'text');
            $('#Password-toggle2 i').removeClass("zmdi-eye");
            $('#Password-toggle2 i').addClass("zmdi-eye-off");
        }
    });
})();