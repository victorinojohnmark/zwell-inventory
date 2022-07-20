$(document).ready(function () {
    $('.datatable').DataTable({
        dom: 'Blfrtip',
        // order: [[2, 'desc']],
        buttons: [
            'copy', 'excel', 'csv', 'pdf', 'colvis'
        ],
    });

    // var buttonCommon = {
    //     init: function (dt, node, config) {
    //       var table = dt.table().context[0].nTable;
    //       // console.log($(table).data('datetime'));
    //       if (table) {
    //         config.title = $(table).data('export-title');
    //         config.filename = config.title + $(table).data('datetime');
    //         config.orientation = $(table).data('orientation');
    //         config.pageSize = $(table).data('page-size');
            
    //       }
    //     },
    //     title: 'default title'
    //   };
    // $.extend( $.fn.dataTable.defaults, {
    //     "buttons": [
    //         $.extend( true, {}, buttonCommon, {
    //             extend: 'copy',
    //         } ),
    //         $.extend( true, {}, buttonCommon, {
    //             extend: 'excelHtml5',
    //             exportOptions: {
    //                 columns: ':visible'
    //             }
    //         } ),
    //         $.extend( true, {}, buttonCommon, {
    //             extend: 'pdfHtml5',
    //             orientation: 'portrait',
    //             exportOptions: {
    //                 columns: ':visible',
    //             },
    //         } ),
    //         $.extend( true, {}, buttonCommon, {
    //             extend: 'print',
    //             exportOptions: {
    //                 columns: ':visible'
    //             },
    //             orientation: 'landscape'
    //         } ),
    //         $.extend( true, {}, buttonCommon, {
    //             extend: 'colvis'
    //         } ),
    //     ]
    // } );
});

