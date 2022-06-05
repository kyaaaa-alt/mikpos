//GENERATE OTP

$('#generate-otp').on('click', function() {
    'use strict'
    
    var value = $(this).html().trim();
    if (value == 'proceed') {
        $(this).html('Login');
        $('#login-otp').css('display', "flex");
        $('#mobile-num').css('display', "none");
    } else {
        $(this).html('Login');
        $('#login-otp').css('display', "flex");
        $('#mobile-num').css('display', "none");
    }
})