(function ($) {
    "use strict";

    // PAGE LOADING
    $(window).on("load", function (e) {
        $("#global-loader").fadeOut("slow");
    })

    // COLOR THEME
    $(document).on("click", "a[data-theme]", function () {
        $("head link#theme").attr("href", $(this).data("theme"));
        $(this).toggleClass('active').siblings().removeClass('active');
    });

    // FULL SCREEN
    $(document).on("click", ".fullscreen-button", function toggleFullScreen() {
        $('.fullscreen-button').addClass('fullscreen-button');
        if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        } else {
            $('html').removeClass('fullscreen-button');
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    })

    // BACK TO TOP BUTTON
    $(window).on("scroll", function (e) {
        if ($(this).scrollTop() > 0) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    $(document).on("click", "#back-to-top", function (e) {
        $("html, body").animate({
            scrollTop: 0
        }, 0);
        return false;
    });


    // COVER IMAGE
    $(".cover-image").each(function () {
        var attr = $(this).attr('data-bs-image-src');
        if (typeof attr !== typeof undefined && attr !== false) {
            $(this).css('background', 'url(' + attr + ') center center');
        }
    });

    // QUANTITY CART INCREASE AND DECREASE
        $('.add').on('click', function () {
            var $qty = $(this).closest('div').find('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
        });
        $('.minus').on('click', function () {
            var $qty = $(this).closest('div').find('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal) && currentVal > 0) {
                $qty.val(currentVal - 1);
            }
        });

    // CHART CIRCLE
    if ($('.chart-circle').length) {
        $('.chart-circle').each(function () {
            let $this = $(this);
            $this.circleProgress({
                fill: {
                    color: $this.attr('data-bs-color')
                },
                size: $this.height(),
                startAngle: -Math.PI / 4 * 2,
                emptyFill: '#edf0f5',
                lineCap: 'round'
            });
        });
    }

    // MODAL
    // SHOWING MODAL WITH EFFECT
    $('.modal-effect').on('click', function (e) {
        e.preventDefault();
        var effect = $(this).attr('data-bs-effect');
        $('#modaldemo8').addClass(effect);
    });

    // HIDE MODAL WITH EFFECT
    $('#modaldemo8').on('hidden.bs.modal', function (e) {
        $(this).removeClass(function (index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
    });

    // CARD
    const DIV_CARD = 'div.card';

    // TOOLTIP
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // POPOVER
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    // BY DEFAULT, BOOTSTRAP DOESN'T AUTO CLOSE POPOVER AFTER APPEARING IN THE PAGE 
    $(document).on('click', function (e) {
        $('[data-toggle="popover"],[data-original-title]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false // fix for BS 3.3.6
            }

        });
    });

    // TOAST
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    $(document).on("click", '#liveToastBtn', function () {
        $('.toast').toast('show');
    })

    //  FUNCTION FOR REMOVE CARD
    $(document).on('click', '[data-bs-toggle="card-remove"]', function (e) {
        let $card = $(this).closest(DIV_CARD);
        $card.remove();
        e.preventDefault();
        return false;
    });


    // FUNCTIONS FOR COLLAPSED CARD
    $(document).on('click', '[data-bs-toggle="card-collapse"]', function (e) {
        let $card = $(this).closest(DIV_CARD);
        $card.toggleClass('card-collapsed');
        e.preventDefault();
        return false;
    });

    // CARD FULL SCREEN
    $(document).on('click', '[data-bs-toggle="card-fullscreen"]', function (e) {
        let $card = $(this).closest(DIV_CARD);
        $card.toggleClass('card-fullscreen').removeClass('card-collapsed');
        e.preventDefault();
        return false;
    });


    // INPUT FILE BROWSER
    $(document).on('change', '.file-browserinput', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    }); // We can watch for our custom `fileselect` event like this

    // FILE UPLOAD
    $('.file-browserinput').on('fileselect', function (event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }
    });



    // ______________ SWITCHER-toggle ______________//

	$('.layout-setting').on("click", function(e) {
		if (!(document.querySelector('body').classList.contains('dark-mode'))) {
			$('body').addClass('dark-mode');
			$('body').removeClass('light-mode');
			$('body').removeClass('transparent-mode');

            $('#myonoffswitch5').prop('checked', true);
            $('#myonoffswitch8').prop('checked', true);

			localStorage.setItem('darkMode', true);
			localStorage.removeItem('lightMode');
			localStorage.removeItem('transparentMode');
            $('#myonoffswitch2').prop('checked', true);
            
		} else {
			$('body').removeClass('dark-mode');
			$('body').addClass('light-mode');
            $('#myonoffswitch3').prop('checked', true);
            $('#myonoffswitch6').prop('checked', true);

			localStorage.setItem('lightMode', true);
			localStorage.removeItem('transparentMode');
			localStorage.removeItem('darkMode');
            $('#myonoffswitch1').prop('checked', true);
		}
	});


    // LIGHT THEME START
    $(document).on("click", '#myonoffswitch1', function () {
        if (this.checked) {
            $('body').addClass('light-mode');
            $('#myonoffswitch3').prop('checked', true);
            $('#myonoffswitch6').prop('checked', true);
            $('body').removeClass('transparent-mode');
            $('body').removeClass('dark-mode');

            // remove dark theme properties	
            localStorage.removeItem('darkPrimary')

            // remove light theme properties
            localStorage.removeItem('primaryColor')
            localStorage.removeItem('primaryHoverColor')
            localStorage.removeItem('primaryBorderColor')
            document.querySelector('html').style.removeProperty('--primary-bg-color', localStorage.darkPrimary);
            document.querySelector('html').style.removeProperty('--primary-bg-hover', localStorage.darkPrimary);
            document.querySelector('html').style.removeProperty('--primary-bg-border', localStorage.darkPrimary);
            document.querySelector('html').style.removeProperty('--dark-primary', localStorage.darkPrimary);

            // removing dark theme properties
            localStorage.removeItem('darkPrimary')
            localStorage.removeItem('transparentBgColor');
            localStorage.removeItem('transparentThemeColor');
            localStorage.removeItem('transparentPrimary');
            localStorage.removeItem('darkprimaryTransparent');


            $('#myonoffswitch1').prop('checked', true);
            $('#myonoffswitch2').prop('checked', false);
            $('#myonoffswitchTransparent').prop('checked', false);
            localStorage.removeItem('transparentBgImgPrimary');
            localStorage.removeItem('transparentBgImgprimaryTransparent');

            checkOptions();
            const root = document.querySelector(':root');
            root.style = "";
            names()
        } else {
            $('body').removeClass('light-mode');
            localStorage.removeItem("light-mode");
        }
        localStorageBackup();
    });
    // LIGHT THEME END

    // DARK THEME START
    $(document).on("click", '#myonoffswitch2', function () {
        if (this.checked) {
            $('body').addClass('dark-mode');

            $('#myonoffswitch5').prop('checked', true);
            $('#myonoffswitch8').prop('checked', true);
            $('body').removeClass('light-mode');
            $('body').removeClass('transparent-mode');

            // remove light theme properties
            localStorage.removeItem('primaryColor')
            localStorage.removeItem('primaryHoverColor')
            localStorage.removeItem('primaryBorderColor')
            localStorage.removeItem('darkPrimary')
            document.querySelector('html').style.removeProperty('--primary-bg-color', localStorage.darkPrimary);
            document.querySelector('html').style.removeProperty('--primary-bg-hover', localStorage.darkPrimary);
            document.querySelector('html').style.removeProperty('--primary-bg-border', localStorage.darkPrimary);
            document.querySelector('html').style.removeProperty('--dark-primary', localStorage.darkPrimary);

            // removing light theme data 
            localStorage.removeItem('primaryColor')
            localStorage.removeItem('primaryHoverColor')
            localStorage.removeItem('primaryBorderColor')
            localStorage.removeItem('primaryTransparent');

            $('#myonoffswitch1').prop('checked', false);
            $('#myonoffswitch2').prop('checked', true);
            $('#myonoffswitchTransparent').prop('checked', false);
            //
            checkOptions();

            localStorage.removeItem('transparentBgColor');
            localStorage.removeItem('transparentThemeColor');
            localStorage.removeItem('transparentPrimary');
            localStorage.removeItem('transparentBgImgPrimary');
            localStorage.removeItem('transparentBgImgprimaryTransparent');
            const root = document.querySelector(':root');
            root.style = "";
            names()
        } else {
            $('body').removeClass('dark-mode');
            localStorage.removeItem("dark-mode");
        }
        localStorageBackup()
    });
    // DARK THEME END

    // TRANSPARENT THEME START
    $(document).on("click", '#myonoffswitchTransparent', function () {
        if (this.checked) {
            $('body').addClass('transparent-mode');
            $('#myonoffswitch3').prop('checked', false);
            $('#myonoffswitch6').prop('checked', false);
            $('#myonoffswitch5').prop('checked', false);
            $('#myonoffswitch8').prop('checked', false);
            $('body').removeClass('dark-mode');
            $('body').removeClass('light-mode');

            // remove light theme properties
            localStorage.removeItem('primaryColor')
            localStorage.removeItem('primaryHoverColor')
            localStorage.removeItem('primaryBorderColor')

            // removing light theme data 
            localStorage.removeItem('darkPrimary');
            localStorage.removeItem('primaryColor')
            localStorage.removeItem('primaryHoverColor')
            localStorage.removeItem('primaryBorderColor')
            localStorage.removeItem('primaryTransparent');
            localStorage.removeItem('transparentPrimary');
            localStorage.removeItem('darkprimaryTransparent');
            localStorage.removeItem('transparentBgImgPrimary');
            localStorage.removeItem('transparentBgImgprimaryTransparent');

            $('#myonoffswitch2').prop('checked', false);
            $('#myonoffswitch1').prop('checked', false);
            $('#myonoffswitchTransparent').prop('checked', true);
            //
            checkOptions();

            const root = document.querySelector(':root');
            root.style = "";
            names()
        } else {
            $('body').removeClass('transparent-mode');
            localStorage.removeItem("transparent-mode");
        }
        localStorageBackup()
        $('body').removeClass('bg-img1');
        $('body').removeClass('bg-img2');
        $('body').removeClass('bg-img3');
        $('body').removeClass('bg-img4');
    });
    // TRANSPARENT THEME END

    // BACKGROUND IMAGE STYLE START

    $(document).on("click", '#bgimage1', function () {
        $('body').addClass('bg-img1');
        $('body').removeClass('bg-img2');
        $('body').removeClass('bg-img3');
        $('body').removeClass('bg-img4');

        document.querySelector('body').classList.add('transparent-mode');
        document.querySelector('body').classList.remove('light-mode');
        document.querySelector('body').classList.remove('dark-mode');

        $('#myonoffswitch2').prop('checked', false);
        $('#myonoffswitch1').prop('checked', false);
        $('#myonoffswitchTransparent').prop('checked', true);

        checkOptions();
    })

    $(document).on("click", '#bgimage2', function () {
        $('body').addClass('bg-img2');
        $('body').removeClass('bg-img1');
        $('body').removeClass('bg-img3');
        $('body').removeClass('bg-img4');

        document.querySelector('body').classList.add('transparent-mode');
        document.querySelector('body').classList.remove('light-mode');
        document.querySelector('body').classList.remove('dark-mode');

        $('#myonoffswitch2').prop('checked', false);
        $('#myonoffswitch1').prop('checked', false);
        $('#myonoffswitchTransparent').prop('checked', true);

        checkOptions();
    })

    $(document).on("click", '#bgimage3', function () {
        $('body').addClass('bg-img3');
        $('body').removeClass('bg-img1');
        $('body').removeClass('bg-img2');
        $('body').removeClass('bg-img4');

        document.querySelector('body').classList.add('transparent-mode');
        document.querySelector('body').classList.remove('light-mode');
        document.querySelector('body').classList.remove('dark-mode');

        $('#myonoffswitch2').prop('checked', false);
        $('#myonoffswitch1').prop('checked', false);
        $('#myonoffswitchTransparent').prop('checked', true);

        checkOptions();
    })

    $(document).on("click", '#bgimage4', function () {
        $('body').addClass('bg-img4');
        $('body').removeClass('bg-img1');
        $('body').removeClass('bg-img2');
        $('body').removeClass('bg-img3');

        document.querySelector('body').classList.add('transparent-mode');
        document.querySelector('body').classList.remove('light-mode');
        document.querySelector('body').classList.remove('dark-mode');
        $('#myonoffswitch2').prop('checked', false);
        $('#myonoffswitch1').prop('checked', false);
        $('#myonoffswitchTransparent').prop('checked', true);

        checkOptions();
    })

    // BACKGROUND IMAGE STYLE END

    // LIGHT LEFTMENU START
    $(document).on("click", '#myonoffswitch3', function () {
        if (this.checked) {
            $('body').addClass('light-menu');
            $('body').removeClass('color-menu');
            $('body').removeClass('dark-menu');
            $('body').removeClass('gradient-menu');
        } else {
            $('body').removeClass('light-menu');
        }
    });
    // LIGHT LEFTMENU END

    // COLOR LEFTMENU START
    $(document).on("click", '#myonoffswitch4', function () {
        if (this.checked) {
            $('body').addClass('color-menu');
            $('body').removeClass('light-menu');
            $('body').removeClass('dark-menu');
            $('body').removeClass('gradient-menu');
        } else {
            $('body').removeClass('color-menu');
        }
    });
    // COLOR LEFTMENU END

    // DARK LEFTMENU START
    $(document).on("click", '#myonoffswitch5', function () {
        if (this.checked) {
            $('body').addClass('dark-menu');
            $('body').removeClass('color-menu');
            $('body').removeClass('light-menu');
            $('body').removeClass('gradient-menu');
        } else {
            $('body').removeClass('dark-menu');
        }
    });
    // DARK LEFTMENU END

    // GRADIENT LEFTMENU START
    $(document).on("click", '#myonoffswitch19', function () {
        if (this.checked) {
            $('body').addClass('gradient-menu');
            $('body').removeClass('color-menu');
            $('body').removeClass('light-menu');
            $('body').removeClass('dark-menu');
        } else {
            $('body').removeClass('gradient-menu');
        }
    });
    // GRADIENT LEFTMENU END

    // LIGHT HEADER START
    $(document).on("click", '#myonoffswitch6', function () {
        if (this.checked) {
            $('body').addClass('header-light');
            $('body').removeClass('color-header');
            $('body').removeClass('dark-header');
            $('body').removeClass('gradient-header');
        } else {
            $('body').removeClass('header-light');
        }
    });
    // LIGHT HEADER END

    // COLOR HEADER START
    $(document).on("click", '#myonoffswitch7', function () {
        if (this.checked) {
            $('body').addClass('color-header');
            $('body').removeClass('header-light');
            $('body').removeClass('dark-header');
            $('body').removeClass('gradient-header');
        } else {
            $('body').removeClass('color-header');
        }
    });
    // COLOR HEADER END

    // DARK HEADER START
    $(document).on("click", '#myonoffswitch8', function () {
        if (this.checked) {
            $('body').addClass('dark-header');
            $('body').removeClass('color-header');
            $('body').removeClass('header-light');
            $('body').removeClass('gradient-header');
        } else {
            $('body').removeClass('dark-header');
        }
    });
    // DARK HEADER END

    // GRADIENT HEADER START
    $(document).on("click", '#myonoffswitch20', function () {
        if (this.checked) {
            $('body').addClass('gradient-header');
            $('body').removeClass('color-header');
            $('body').removeClass('header-light');
            $('body').removeClass('dark-header');
        } else {
            $('body').removeClass('gradient-header');
        }
    });
    // GRADIENT HEADER END

    // FULL WIDTH LAYOUT START
    $(document).on("click", '#myonoffswitch9', function () {
        if (this.checked) {
            $('body').addClass('layout-fullwidth');
            $('body').removeClass('layout-boxed');
            checkHoriMenu();
        } else {
            $('body').removeClass('layout-fullwidth');
        }
    });
    // FULL WIDTH LAYOUT END

    // BOXED LAYOUT START
    $(document).on("click", '#myonoffswitch10', function () {
        if (this.checked) {
            $('body').addClass('layout-boxed');
            $('body').removeClass('layout-fullwidth');
            checkHoriMenu();
        } else {
            $('body').removeClass('layout-boxed');
        }
    });
    // BOXED LAYOUT END

    // HEADER POSITION STYLES START
    $(document).on("click", '#myonoffswitch11', function () {
        if (this.checked) {
            $('body').addClass('fixed-layout');
            $('body').removeClass('scrollable-layout');
        } else {
            $('body').removeClass('fixed-layout');
        }
    });
    $(document).on("click", '#myonoffswitch12', function () {
        if (this.checked) {
            $('body').addClass('scrollable-layout');
            $('body').removeClass('fixed-layout');
        } else {
            $('body').removeClass('scrollable-layout');
        }
    });
    // HEADER POSITION STYLES END

    // DEFAULT SIDEMENU START
    $(document).on("click", '#myonoffswitch13', function () {
        if (this.checked) {
            $('body').addClass('default-menu');
            $('body').removeClass('sidenav-toggled');
            hovermenu();
            $('body').removeClass('icontext-menu');
            $('body').removeClass('icon-overlay');
            $('body').removeClass('closed-leftmenu');
            $('body').removeClass('hover-submenu');
            $('body').removeClass('hover-submenu1');
        } else {
            $('body').removeClass('default-menu');
        }
    });
    // DEFAULT SIDEMENU END

    // ICON OVERLAY SIDEMENU START
    $(document).on("click", '#myonoffswitch15', function () {
        if (this.checked) {
            $('body').addClass('icon-overlay');
            hovermenu();
            $('body').addClass('sidenav-toggled');
            $('body').removeClass('hover-submenu1');
            $('body').removeClass('default-menu');
            $('body').removeClass('closed-leftmenu');
            $('body').removeClass('hover-submenu');
            $('body').removeClass('icontext-menu');
        } else {
            $('body').removeClass('icon-overlay');
            $('body').removeClass('sidenav-toggled');
        }
    });
    // ICON OVERLAY SIDEMENU END

    // ICONTEXT SIDEMENU START
    $(document).on("click", '#myonoffswitch14', function () {
        if (this.checked) {
            $('body').addClass('icontext-menu');
            icontext();
            $('body').addClass('sidenav-toggled');
            $('body').removeClass('icon-overlay');
            $('body').removeClass('hover-submenu1');
            $('body').removeClass('default-menu');
            $('body').removeClass('closed-leftmenu');
            $('body').removeClass('hover-submenu');
        } else {
            $('body').removeClass('icontext-menu');
            $('body').removeClass('sidenav-toggled');
        }
    });
    // ICONTEXT SIDEMENU END

    // CLOSED SIDEMENU START
    $(document).on("click", '#myonoffswitch16', function () {
        if (this.checked) {
            $('body').addClass('closed-leftmenu');
            $('body').addClass('sidenav-toggled');
            $('body').removeClass('default-menu');
            $('body').removeClass('hover-submenu1');
            $('body').removeClass('hover-submenu');
            $('body').removeClass('icon-overlay');
            $('body').removeClass('icontext-menu');

        } else {
            $('body').removeClass('closed-leftmenu');
            $('body').removeClass('sidenav-toggled');
            $('body').addClass('default-menu');
        }
    });
    // CLOSED SIDEMENU END

    // HOVER SUBMENU START
    $(document).on("click", '#myonoffswitch17', function () {
        if (this.checked) {
            $('body').addClass('hover-submenu');
            hovermenu();
            $('body').addClass('sidenav-toggled');
            $('body').removeClass('hover-submenu1');
            $('body').removeClass('default-menu');
            $('body').removeClass('closed-leftmenu');
            $('body').removeClass('icon-overlay');
            $('body').removeClass('icontext-menu');
            $('.app-sidebar').removeClass('sidemenu-scroll');
        } else {
            $('body').removeClass('hover-submenu');
            $('body').removeClass('sidenav-toggled');
        }
    });
    // HOVER SUBMENU END

    // HOVER SUBMENU STYLE-1 START
    $(document).on("click", '#myonoffswitch18', function () {
        if (this.checked) {
            $('body').addClass('hover-submenu1');
            hovermenu();
            $('body').addClass('sidenav-toggled');
            $('body').removeClass('hover-submenu');
            $('body').removeClass('default-menu');
            $('body').removeClass('closed-leftmenu');
            $('body').removeClass('icon-overlay');
            $('body').removeClass('icontext-menu');
            $('.app-sidebar').removeClass('sidemenu-scroll');
        } else {
            $('body').removeClass('hover-submenu1');
            $('body').removeClass('sidenav-toggled');
        }
    });
    // HOVER SUBMENU STYLE-1 END

    // ACCORDION STYLE
    $(document).on("click", '[data-bs-toggle="collapse"]', function () {
        $(this).toggleClass('active').siblings().removeClass('active');
    });

    // EMAIL INBOX
    $(".clickable-row").on('click', function () {
        window.location = $(this).data("href");
    });


    let bodyhorizontal = $('body').hasClass('horizontal');
    if (bodyhorizontal) {
        ActiveSubmenu();
        $('body').addClass('horizontal');
        $(".main-content").addClass("hor-content");
        $(".main-content").removeClass("app-content");
        $(".main-container").addClass("container");
        $(".main-container").removeClass("container-fluid");
        $(".app-header").addClass("hor-header");
        $(".hor-header").removeClass("app-header");
        $(".app-sidebar").addClass("horizontal-main")
        $(".main-sidemenu").addClass("container")
        $('body').removeClass('sidebar-mini');
        $('body').removeClass('sidenav-toggled');
        $('body').removeClass('horizontal-hover');
        $('body').removeClass('default-menu');
        $('body').removeClass('icontext-menu');
        $('body').removeClass('icon-overlay');
        $('body').removeClass('closed-leftmenu');
        $('body').removeClass('hover-submenu');
        $('body').removeClass('hover-submenu1');
        localStorage.setItem("horizantal", "True");
        // // To enable no-wrap horizontal style
        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        document.querySelector('.horizontal .side-menu').style.flexWrap = 'nowrap'
        // To enable wrap horizontal style
        // $('#slide-left').addClass('d-none');
        // $('#slide-right').addClass('d-none');
        // document.querySelector('.horizontal .side-menu').style.flexWrap = 'wrap'
        checkHoriMenu();
        responsive();
    } 

    function light() {
        "use strict";
        if (document.querySelector('body').classList.contains('light-mode')) {
            $('#myonoffswitch3').prop('checked', true);
            $('#myonoffswitch6').prop('checked', true);
        }
    }
    light();
    let bodyhorizontalHover = $('body').hasClass('horizontal-hover');
    if (bodyhorizontalHover) {
        if(window.innerWidth>=992){
            let li = document.querySelectorAll('.side-menu li')
            li.forEach((e, i) => {
                e.classList.remove('is-expanded')
            })
            var animationSpeed = 300;
            // first level
            var parent = $("[data-bs-toggle='sub-slide']").parents('ul');
            var ul = parent.find('ul:visible').slideUp(animationSpeed);
            ul.removeClass('open');
            var parent1 = $("[data-bs-toggle='sub-slide2']").parents('ul');
            var ul1 = parent1.find('ul:visible').slideUp(animationSpeed);
            ul1.removeClass('open');
        }
        $('body').addClass('horizontal-hover');
        $('body').addClass('horizontal');
        // $('#slide-left').addClass('d-none');
        // $('#slide-right').addClass('d-none');
        // document.querySelector('.horizontal .side-menu').style.flexWrap = 'wrap'
        $('#slide-left').addClass('d-none');
        $('#slide-right').addClass('d-none');
        document.querySelector('.horizontal .side-menu').style.flexWrap = 'wrap'
        $(".main-content").addClass("hor-content");
        $(".main-content").removeClass("app-content");
        $(".main-container").addClass("container");
        $(".main-container").removeClass("container-fluid");
        $(".app-header").addClass("hor-header");
        $(".app-header").removeClass("app-header");
        $(".app-sidebar").addClass("horizontal-main")
        $(".main-sidemenu").addClass("container")
        $('body').removeClass('sidebar-mini');
        $('body').removeClass('sidenav-toggled');
        $('body').removeClass('default-menu');
        $('body').removeClass('icontext-menu');
        $('body').removeClass('icon-overlay');
        $('body').removeClass('closed-leftmenu');
        $('body').removeClass('hover-submenu');
        $('body').removeClass('hover-submenu1');
        checkHoriMenu();
        responsive();
    }

})(jQuery);

// REPLY
function replay() {
    "use strict";

    let replayButtom = document.querySelectorAll('.reply a')
    // Creating Div
    let Div = document.createElement('div')
    Div.setAttribute('class', "comment mt-5 d-grid")
    // creating textarea
    let textArea = document.createElement('textarea')
    textArea.setAttribute('class', "form-control")
    textArea.setAttribute('rows', "5")
    textArea.innerText = "Your Comment";
    // creating Cancel buttons
    let cancelButton = document.createElement('button');
    cancelButton.setAttribute('class', "btn btn-danger");
    cancelButton.innerText = "Cancel";

    let buttonDiv = document.createElement('div')
    buttonDiv.setAttribute('class', "btn-list ms-auto mt-2")

    // Creating submit button
    let submitButton = document.createElement('button');
    submitButton.setAttribute('class', "btn btn-success ms-3");
    submitButton.innerText = "Submit";

    // appending text are to div
    Div.append(textArea)
    Div.append(buttonDiv);
    buttonDiv.append(cancelButton);
    buttonDiv.append(submitButton);

    replayButtom.forEach((element, index) => {

        element.addEventListener('click', () => {
            let replay = $(element).parent()
            replay.append(Div)

            cancelButton.addEventListener('click', () => {
                Div.remove()
            })
        })
    })


}
replay()

// OFF-CANVAS STYLE
$('.off-canvas').on('click', function () {
    $('body').addClass('overflow-y-scroll');
    $('body').addClass('pe-0');
});

// RTL STYLE START
$(document).on("click", '#myonoffswitch24', function () {
    if (this.checked) {
        $('body').addClass('rtl');

        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        $("html[lang=en]").attr("dir", "rtl");
        $('body').removeClass('ltr');
        localStorage.setItem("rtl", "True");
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css"));
        var carousel = $('.owl-carousel');
        $.each(carousel, function (index, element) {
            // element == this
            var carouselData = $(element).data('owl.carousel');
            carouselData.settings.rtl = true; //don't know if both are necessary
            carouselData.options.rtl = true;
            $(element).trigger('refresh.owl.carousel');
        });
    } else {
        $('body').removeClass('rtl');
        $('body').addClass('ltr');
        localStorage.setItem("rtl", "false");
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.min.css"));
    }
});
// RTL STYLE END

// LTR STYLE START
$(document).on("click", '#myonoffswitch23', function () {
    if (this.checked) {
        $('body').addClass('ltr');

        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        $("html[lang=en]").attr("dir", "ltr");
        $('body').removeClass('rtl');
        localStorage.setItem("ltr", "True");
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.min.css"));
        var carousel = $('.owl-carousel');
        $.each(carousel, function (index, element) {
            // element == this
            var carouselData = $(element).data('owl.carousel');
            carouselData.settings.rtl = false; //don't know if both are necessary
            carouselData.options.rtl = false;
            $(element).trigger('refresh.owl.carousel');
        });
    } else {
        $('body').removeClass('ltr');
        $('body').addClass('rtl');
        localStorage.setItem("ltr", "false");
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "../assets/plugins/bootstrap/css/bootstrap.rtl.min.css"));
    }
});
// LTR STYLE END


$(document).on("click", '#myonoffswitch34', function () {
    if (this.checked) {
        ActiveSubmenu();
        $('body').removeClass('horizontal');
        $('body').removeClass('horizontal-hover');
        $(".main-content").removeClass("hor-content");
        $(".main-content").addClass("app-content");
        $(".main-container").removeClass("container");
        $(".main-container").addClass("container-fluid");
        $(".app-header").removeClass("hor-header");
        $(".hor-header").addClass("app-header");
        $(".app-sidebar").removeClass("horizontal-main")
        $(".main-sidemenu").removeClass("container")
        $(".slide-menu").removeClass("ps")
        $(".slide-menu").removeClass("ps--active-y")
        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        $('body').addClass('sidebar-mini');
        localStorage.setItem("sidebar-mini", "True");
        responsive();
        
        if(!(document.querySelector('.icontext-menu')!== null)){
            hovermenu();
        }
        
    } else {
        $('body').removeClass('sidebar-mini');
        localStorage.setItem("sidebar-mini", "False");
    }
});

// HORIZONTAL
$(document).on("click", '#myonoffswitch35', function () {
    if (this.checked) {
        ActiveSubmenu();
        $('body').addClass('horizontal');
        $(".main-content").addClass("hor-content");
        $(".main-content").removeClass("app-content");
        $(".main-container").addClass("container");
        $(".main-container").removeClass("container-fluid");
        $(".app-header").addClass("hor-header");
        $(".hor-header").removeClass("app-header");
        $(".app-sidebar").addClass("horizontal-main")
        $(".main-sidemenu").addClass("container")
        $('body').removeClass('sidebar-mini');
        $('body').removeClass('sidenav-toggled');
        $('body').removeClass('horizontal-hover');
        $('body').removeClass('default-menu');
        $('body').removeClass('icontext-menu');
        $('body').removeClass('icon-overlay');
        $('body').removeClass('closed-leftmenu');
        $('body').removeClass('hover-submenu');
        $('body').removeClass('hover-submenu1');
        localStorage.setItem("horizantal", "True");
        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        document.querySelector('.horizontal .side-menu').style.flexWrap = 'nowrap'
        // $('#slide-left').addClass('d-none');
        // $('#slide-right').addClass('d-none');
        // document.querySelector('.horizontal .side-menu').style.flexWrap = 'wrap'
        checkHoriMenu();
        responsive();
    } else {
        $('body').removeClass('horizontal');
        localStorage.setItem("horizontal", "False");
    }
});

// HORIZONTAL END

// HORIZONTAL HOVER
$(document).on("click", '#myonoffswitch111', function () {
    if (this.checked) {
        if(window.innerWidth>=992){
            let li = document.querySelectorAll('.side-menu li')
            li.forEach((e, i) => {
                e.classList.remove('is-expanded')
            })
            var animationSpeed = 300;
            // first level
            var parent = $("[data-bs-toggle='sub-slide']").parents('ul');
            var ul = parent.find('ul:visible').slideUp(animationSpeed);
            ul.removeClass('open');
            var parent1 = $("[data-bs-toggle='sub-slide2']").parents('ul');
            var ul1 = parent1.find('ul:visible').slideUp(animationSpeed);
            ul1.removeClass('open');
        }
        $('body').addClass('horizontal-hover');
        $('body').addClass('horizontal');
        // $('#slide-left').addClass('d-none');
        // $('#slide-right').addClass('d-none');
        // document.querySelector('.horizontal .side-menu').style.flexWrap = 'wrap'
        document.querySelector('.horizontal .side-menu').style.flexWrap = 'nowrap';
        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        $(".main-content").addClass("hor-content");
        $(".main-content").removeClass("app-content");
        $(".main-container").addClass("container");
        $(".main-container").removeClass("container-fluid");
        $(".app-header").addClass("hor-header");
        $(".app-header").removeClass("app-header");
        $(".app-sidebar").addClass("horizontal-main")
        $(".main-sidemenu").addClass("container")
        $('body').removeClass('sidebar-mini');
        $('body').removeClass('sidenav-toggled');
        $('body').removeClass('default-menu');
        $('body').removeClass('icontext-menu');
        $('body').removeClass('icon-overlay');
        $('body').removeClass('closed-leftmenu');
        $('body').removeClass('hover-submenu');
        $('body').removeClass('hover-submenu1');
        checkHoriMenu();
        responsive();
    } else {
        $('body').removeClass('horizontal-hover');
        localStorage.setItem("horizontal-hover", "False");
    }

});

// HORIZONTAL HOVER END

// CHECK OPTIONS
function checkOptions() {
    "use strict";

    // light header 
    if (document.querySelector('body').classList.contains('header-light')) {
        $('#myonoffswitch6').prop('checked', true);
    }
    // color header 
    if (document.querySelector('body').classList.contains('color-header')) {
        $('#myonoffswitch7').prop('checked', true);
    }
    // gradient header 
    if (document.querySelector('body').classList.contains('gradient-header')) {
        $('#myonoffswitch20').prop('checked', true);
    }
    // dark header 
    if (document.querySelector('body').classList.contains('dark-header')) {
        $('#myonoffswitch8').prop('checked', true);
    }

    // light menu
    if (document.querySelector('body').classList.contains('light-menu')) {
        $('#myonoffswitch3').prop('checked', true);
    }
    // color menu
    if (document.querySelector('body').classList.contains('color-menu')) {
        $('#myonoffswitch4').prop('checked', true);
    }
    // gradient menu
    if (document.querySelector('body').classList.contains('gradient-menu')) {
        $('#myonoffswitch19').prop('checked', true);
    }
    // dark menu
    if (document.querySelector('body').classList.contains('dark-menu')) {
        $('#myonoffswitch5').prop('checked', true);
    }
}

// RESET SWITCHER TO DEFAULT
function resetData() {
    "use strict";

    $('#myonoffswitch3').prop('checked', true);
    $('#myonoffswitch6').prop('checked', true);
    $('#myonoffswitch1').prop('checked', true);
    $('#myonoffswitch9').prop('checked', true);
    $('#myonoffswitch10').prop('checked', false);
    $('#myonoffswitch11').prop('checked', true);
    $('#myonoffswitch12').prop('checked', false);
    $('#myonoffswitch13').prop('checked', true);
    $('#myonoffswitch14').prop('checked', false);
    $('#myonoffswitch15').prop('checked', false);
    $('#myonoffswitch16').prop('checked', false);
    $('#myonoffswitch17').prop('checked', false);
    $('#myonoffswitch18').prop('checked', false);
    $('body')?.removeClass('bg-img4');
    $('body')?.removeClass('bg-img1');
    $('body')?.removeClass('bg-img2');
    $('body')?.removeClass('bg-img3');
    $('body')?.removeClass('transparent-mode');
    $('body')?.removeClass('dark-mode');
    $('body')?.removeClass('dark-menu');
    $('body')?.removeClass('color-menu');
    $('body')?.removeClass('gradient-menu');
    $('body')?.removeClass('dark-header');
    $('body')?.removeClass('color-header');
    $('body')?.removeClass('gradient-header');
    $('body')?.removeClass('layout-boxed');
    $('body')?.removeClass('icontext-menu');
    $('body')?.removeClass('icon-overlay');
    $('body')?.removeClass('closed-leftmenu');
    $('body')?.removeClass('hover-submenu');
    $('body')?.removeClass('hover-submenu1');
    $('body')?.removeClass('sidenav-toggled');
    $('body')?.removeClass('scrollable-layout');
    names();
}





