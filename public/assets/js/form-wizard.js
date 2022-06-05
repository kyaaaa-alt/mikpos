(function($) {
    "use strict";
    
    // WIZARD 1
    $('#wizard1').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>'
    });

    // WIZARD 2
    $('#wizard2').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>',
        onStepChanging: function(event, currentIndex, newIndex) {
            if (currentIndex < newIndex) {
                // Step 1 form validation
                if (currentIndex === 0) {
                    var fname = $('#firstname').parsley();
                    var lname = $('#lastname').parsley();
                    if (fname.isValid() && lname.isValid()) {
                        return true;
                    } else {
                        fname.validate();
                        lname.validate();
                    }
                }
                // Step 2 form validation
                if (currentIndex === 1) {
                    var email = $('#email').parsley();
                    if (email.isValid()) {
                        return true;
                    } else {
                        email.validate();
                    }
                }
                // Always allow step back to the previous step even if the current step is not valid.
            } else {
                return true;
            }
        }
    });

    // WIZARD 3
    $('#wizard3').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>',
        stepsOrientation: 1
    });

    // DROPIFY
    $('.dropify-clear').on('click', function () {
        $('.dropify-render img').remove();
        $(".dropify-preview").css("display", "none");
        $(".dropify-clear").css("display", "none");
    });

    // ACCORDION WIZARD
    var options = {
        mode: 'wizard',
        autoButtonsNextClass: 'btn btn-primary float-end',
        autoButtonsPrevClass: 'btn btn-light',
        stepNumberClass: 'badge rounded-pill bg-primary me-1',
        onSubmit: function() {
            alert('Form submitted!');
            return true;
        }
    }
    $("#form").accWizard(options);

})(jQuery);

//Function to show image before upload

function readURL(input) {
    'use strict'
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.dropify-render img').remove();
            var img = $('<img id="dropify-img">'); //Equivalent: $(document.createElement('img'))
            img.attr('src', e.target.result);
            img.appendTo('.dropify-render');
            $(".dropify-preview").css("display", "block");
            $(".dropify-clear").css("display", "block");
        };
        reader.readAsDataURL(input.files[0]);
    }
}