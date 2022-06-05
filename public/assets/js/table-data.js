$(function(e) {
    "use strict";

    //______Basic Data Table
    $('#basic-datatable2').DataTable({
        lengthChange: false,
        pageLength: 17,
        autoWidth: true,
        lengthChange: false,
        dom:'<"pull-left"f><"pull-right"l>tip',
        "language": {
            "search": '',
            "infoFiltered": "",
            "searchPlaceholder": "Search",
            "info": '<i class="fa fa-trash text-danger"></i> delete | <i class="fa fa-th-list"></i> Detail/Perpanjang/Convert | <i class="fa fa-unlock text-success"></i> enable | <i class="fa fa-lock text-warning"></i> disable | <i class="fa fa-pencil-square-o "></i> edit',
            "paginate": {
                "previous": "<strong><<</strong>",
                "next": "<strong>>></strong>"
            }
        },
        initComplete: function () {
            $("#basic-datatable2_filter").append('<button class="btn btn-primary btn-sm ms-2 mb-2 blok2" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle"></i> Add PPPoE Secret</button>')
            // this.api().columns([2]).every( function () {
            //     var column = this;
            //     var select = $('<select><option value="">PROFILE</option></select>')
            //         .appendTo( $(column.header()).empty() )
            //         .on( 'change', function () {
            //             var val = $.fn.dataTable.util.escapeRegex(
            //                 $(this).val()
            //             );
            //             console.log(val, $(this).val())
            //             column
            //                 .search( val ? '^'+val+'$' : '', true, false )
            //                 .draw();
            //         } );

            //     column.data().unique().sort().each( function ( d, j ) {
            //         select.append( '<option value="'+d+'">'+d+'</option>' )
            //     } );
            // });
        },
        "ordering": false
    });


    //______Basic Data Table
    $('#responsive-datatable2').DataTable({
        pageLength: 17,
        autoWidth: true,
        lengthChange: false,
        dom:'<"pull-left"f><"pull-right"l>tip',
        "language": {
            "search": '',
            "infoFiltered": "",
            "searchPlaceholder": "Search",
            "paginate": {
                "previous": "<strong><<</strong>",
                "next": "<strong>>></strong>"
            }
        },
        "ordering": false
    });

    //______File-Export Data Table
    var table = $('#file-datatable').DataTable({
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        language: {
            searchPlaceholder: 'Search...',
            scrollX: "100%",
            sSearch: '',
        }
    });
    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

    //______Delete Data Table
    var table = $('#delete-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });
    $('#delete-datatable tbody').on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').on('click', function() {
        table.row('.selected').remove().draw(false);
    });
    $('#example3333').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
    $('#example222').DataTable({
        aaSorting: [],
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});

    /* Plugin API method to determine is a column is sortable */
    $.fn.dataTable.Api.register('column().searchable()', function() {
        var ctx = this.context[0];
        return ctx.aoColumns[this[0]].bSearchable;
    });

    function createDropdowns(api) {
        api.columns().every(function() {
            if (this.searchable()) {
                var that = this;
                var col = this.index();

                // Only create if not there or blank
                var selected = $('thead tr:eq(1) td:eq(' + col + ') select').val();
                if (selected === undefined || selected === '') {
                    // Create the `select` element
                    $('thead tr:eq(1) td')
                        .eq(col)
                        .empty();
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($('thead tr:eq(1) td').eq(col))
                        .on('change', function() {
                            that.column(col).search('^' + $(this).val() + '$', true, false).draw();
                            createDropdowns(api);
                        });

                    api
                        .cells(null, col, {
                            search: 'applied'
                        })
                        .data()
                        .sort()
                        .unique()
                        .each(function(d) {
                            select.append($('<option>' + d + '</option>'));
                        });
                }
            }
        });
    }

    $('#example2').DataTable( {
        aaSorting: [],
        responsive: true,
        pageLength: 15,
        autoWidth: true,
        lengthChange: false,
        "language": {
            "lengthMenu": '<select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">'+
                '<option value="15">15</option>'+
                '<option value="20">20</option>'+
                '<option value="30">30</option>'+
                '<option value="40">40</option>'+
                '<option value="50">50</option>'+
                '<option value="-1">All</option>'+
                '</select>',
            "search": "",
            "searchPlaceholder": "Search",
            "paginate": {
                "previous": "<strong><</strong>",
                "next": "<strong>></strong>"
            }
        },
        initComplete: function () {
            this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select><option value="">PROFILE</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        console.log(val, $(this).val())
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    // Change the select statement for the search to work
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                    //select.append( "<option value='"+d+"'>"+d+"</option>" )
                } );
            } );
        },
        columnDefs: [
            { orderable: false, targets: [0, 1, 2,  3, 4] }
        ],
    });

    var oTable; //global variable to hold reference to dataTables
    var oSettings; //global variable to hold reference to dataTables settings
    oTable = $('#example3').DataTable( {
        bSortClasses: false,
        aaSorting: [],
        // responsive: true,
        pageLength: 17,
        autoWidth: true,
        lengthChange: false,
        dom:'<"pull-left"f><"pull-right"l>tip',
        "language": {
            "search": '',
            "infoFiltered": "",
            "searchPlaceholder": "Search",
            "info": 'total users : _TOTAL_ | <i class="fa fa-unlock text-success"></i> enable | <i class="fa fa-lock text-warning"></i> disable | <i class="fa fa-pencil-square-o "></i> edit',
            "paginate": {
                "previous": "<strong><<</strong>",
                "next": "<strong>>></strong>"
            }
        },
        paging: true,
        initComplete: function () {
            $("#example3_filter").append('<span class="blok1"><br/></span><button class="btn btn-danger btn-sm ms-2 blok2" id="delselbutton"><i class="fa fa-trash"></i> <span id="countdelete"></span> Delete</button> <button class="btn btn-danger btn-sm ms-2 blok2" id="delcombutton"><i class="fa fa-trash"></i> <span id="countdelete2"></span> Delete by comment</button> <a class="btn btn-primary btn-sm ms-2 blok2" id="adduser" href="adduser"><i class="fa fa-user-plus"></i>  Add User</a> <a class="btn btn-primary btn-sm ms-2 blok2" id="generateusers" href="generateusers"><i class="fa fa-user-plus"></i>  Generate</a> <a class="btn btn-primary btn-sm ms-2 blok2" id="extendexpire" href="extendexpire"><i class="fa fa-clock-o"></i> Perpanjang</a><form target="_blank" style="display:inline !important;" name="print" action="printvoucher" method="POST"><input type="hidden" id="komentar" name="ucomment"/> <button type="submit" class="btn btn-primary btn-sm ms-2 blok2" id="userspdf"><i class="fa fa-print"></i>  Print by comment</button></form>')
            this.api().columns([3]).every( function () {
                var column = this;
                var select = $('<select><option value="">PROFILE</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        console.log(val, $(this).val())
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            this.api().columns([7]).every( function () {
                var column = this;
                var select = $('<select id="komen"><option value="">COMMENT</option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        console.log(val, $(this).val())
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        columnDefs: [
            {
                orderable: false,
                targets: [ 0, 3, 7 ]
            }
        ],
    });
    oSettings = oTable.settings();
    $('#delselbutton').on('click', function(event) {
        var uids = jQuery.map($('.checkBoxClass:checked'), function (n, i) {
            return n.value;
        }).join(',');
        var urlp = $('#example3').data('delbyuids');
        // console.log(uids);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : urlp,
                    method : "POST",
                    data : {uids: uids},
                    async : true,
                    dataType : 'html',
                    success: function($hasil){
                        if($hasil == 'ok'){
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        })
    });
    $('#komen').on('change', function() {
        var koment = $("#komen").val();
        $('#komentar').val(koment);
        

        if ($("#komen").val() === "") {
            $('#delcombutton').hide();
            oSettings[0]._iDisplayLength = 17;
            oTable.draw();  
        } else {
            $('#delcombutton').show();
            oSettings[0]._iDisplayLength = oSettings[0].fnRecordsTotal();
            oTable.draw();  
        }

        const regex = /(vc|up)-[0-9]/g;
        if (koment.search(regex)>-1) {
            $('#userspdf').show();
        } else {
            $('#userspdf').hide();
        }

        // if (koment.indexOf("vc-1")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-2")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-3")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-4")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-5")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-6")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-7")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("vc-8")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-1")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-2")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-3")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-4")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-5")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-6")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-7")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-8")>-1) {
        //     $('#userspdf').show();
        // } else if (koment.indexOf("up-9")>-1) {
        //     $('#userspdf').show();
        // } else {
        //     $('#userspdf').hide();
        // }
    });
    $('#delcombutton').on('click', function(event) {
        var uids = jQuery.map($('.checkBoxClass'), function (n, i) {
            return n.value;
        }).join(',');
        var ucomment = $("#komen").val();
        var urlp = $('#example3').data('delbycomment');
        // console.log(uids);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();}});
                $.ajax({
                    url : urlp,
                    method : "POST",
                    data : {uids: uids,ucomment: ucomment},
                    async : true,
                    dataType : 'html',
                    success: function($hasil){
                        if($hasil == 'ok'){
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        })
    });

    // $('#userspdf').on('click', function(event) {
    //     var ucomment = $("#komen").val();
    //     console.log(ucomment);
    //     var urlpdf = $('#example3').data('urlpdf');
    //     console.log(urlpdf);
    //     $.ajax({
    //         url : urlpdf,
    //         method : "POST",
    //         data : {ucomment: ucomment},
    //         async : true,
    //         dataType : 'html',
    //         success: function($hasil){
    //             if($hasil == 'ok'){
    //                 location.reload();
    //             } else {
    //                 location.reload();
    //             }
    //         }
    //     });
    // });

    var currcomm = $('#example3').data('selectkomentar');
    $('#komen').val(currcomm).change();


    // //______Select2 
    // $('.select2').select2({
    //     minimumResultsForSearch: Infinity
    // });

});