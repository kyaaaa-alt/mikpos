(function($) {
    "use strict";

    //colored tooltip
    var tooltip = new bootstrap.Tooltip(document.querySelector('[data-bs-toggle="tooltip-primary"]'), {
        template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    })
    var tooltip = new bootstrap.Tooltip(document.querySelector('[data-bs-toggle="tooltip-secondary"]'), {
        template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    })
    var tooltip = new bootstrap.Tooltip(document.querySelector('[data-bs-toggle="tooltip-danger"]'), {
        template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    })
    var tooltip = new bootstrap.Tooltip(document.querySelector('[data-bs-toggle="tooltip-info"]'), {
        template: '<div class="tooltip tooltip-info" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
    })

    //Colored Head Popover
    var popover = new bootstrap.Popover(document.querySelector('[data-bs-popover-color="head-primary"]'), {
        template: '<div class="popover popover-head-primary" role="tooltip"><div class="popover-arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
    })
    var popover = new bootstrap.Popover(document.querySelector('[data-bs-popover-color="head-secondary"]'), {
        template: '<div class="popover popover-head-secondary" role="tooltip"><div class="popover-arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
    })

    //Full Colored Popover
    var popover = new bootstrap.Popover(document.querySelector('[data-bs-popover-color="primary"]'), {
        template: '<div class="popover popover-primary" role="tooltip"><div class="popover-arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
    })
    var popover = new bootstrap.Popover(document.querySelector('[data-bs-popover-color="secondary"]'), {
        template: '<div class="popover popover-secondary" role="tooltip"><div class="popover-arrow"><\/div><h3 class="popover-header"><\/h3><div class="popover-body"><\/div><\/div>'
    })

    //Popover
    $(document).on('click', function(e) {
        $('[data-bs-toggle="popover"]').each(function() {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false
            }
        });
    });

})(jQuery);