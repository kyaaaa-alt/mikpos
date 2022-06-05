
$('#autofill-table').DataTable( {
    autoFill: true
} );

$('#hor-autofill').DataTable( {
    autoFill: {
        horizontal: false
    }
} );

$('#enable-autofill').DataTable( {
    autoFill: {
        enable: false
    },
    dom: 'Bfrtip',
    buttons: [
        {
            text: "Enable AutoFill",
            action: function (e, dt) {
                if ( dt.autoFill().enabled() ) {
                    this.autoFill().disable();
                    this.text( 'Enable AutoFill' );
                }
                else {
                    this.autoFill().enable();
                    this.text( 'Disable AutoFill' );
                }
            }
        }
    ]
} );

$('#key-table').DataTable( {
    keys: true,
    autoFill: true
} );

//______Select2 
$('.select2').select2({
    minimumResultsForSearch: Infinity
});