// Swticher Cookie Base
/**
 * Styleswitch stylesheet switcher built on jQuery
 * Under an Attribution, Share Alike License
 * By Kelvin Luck ( http://www.kelvinluck.com/ )
 * Thanks for permission! 
 **/

// DEMO Swticher Base
jQuery('.demo-icon').click(function() {
    if ($('.demo_changer').hasClass("active")) {
        $('.demo_changer').animate({ "right": "-270px" }, function() {
            $('.demo_changer').toggleClass("active");
        });
    } else {
        $('.demo_changer').animate({ "right": "0px" }, function() {
            $('.demo_changer').toggleClass("active");
        });
    }
});

//p-scroll bar
const ps5 = new PerfectScrollbar('.sidebar-right1', {
    useBothWheelAxes: true,
    suppressScrollX: true,
});


// Switcher Close //
$(document).on("click", ".app-content", function() {
    if ($('.demo_changer').hasClass("active")) {
        $('.demo_changer').animate({ "right": "-270px" }, function() {
            $('.demo_changer').toggleClass("active");
        });
    }
});
$(document).on("click", ".hor-content", function() {
    if ($('.demo_changer').hasClass("active")) {
        $('.demo_changer').animate({ "right": "-270px" }, function() {
            $('.demo_changer').toggleClass("active");
        });
    }
});
$(document).on("click", ".login-img .page", function() {
    if ($('.demo_changer').hasClass("active")) {
        $('.demo_changer').animate({ "right": "-270px" }, function() {
            $('.demo_changer').toggleClass("active");
        });
    }
});