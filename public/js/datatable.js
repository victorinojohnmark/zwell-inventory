$(document).ready(function () {
    $('.datatable').DataTable({
        dom: 'Blfrtip',
        // order: [[2, 'desc']],
        // buttons: [
        //     'copy', 'excel', 'pdf',
        // ],
    });

    var buttonCommon = {
        init: function (dt, node, config) {
          var table = dt.table().context[0].nTable;
          // console.log($(table).data('datetime'));
          if (table) {
            config.title = $(table).data('export-title');
            config.filename = config.title + $(table).data('datetime');
            config.orientation = $(table).data('orientation');
            config.pageSize = $(table).data('page-size');
            
          }
        },
        title: 'default title'
      };
    $.extend( $.fn.dataTable.defaults, {
        "buttons": [
            $.extend( true, {}, buttonCommon, {
                extend: 'copy',
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                // download: 'open',
                exportOptions: {
                    columns: ':visible',
                    
                },
                customize: function (doc) {
                let pdfTitle = doc.content[0].text;
                //delete main header
                doc.content.splice(0,1);
                doc['header']=(function() {
                    return {
                    columns: [
                        // {
                        //   image: logo,
                        //   width: 24
                        // },
                        {
                        alignment: 'left',
                        italics: false,
                        text: pdfTitle,
                        fontSize: 14,
                        margin: [20, 0]
                        },

                    ],
                    margin: 20
                    }
                });
                }
            } ),
            $.extend( true, {}, buttonCommon, {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                },
                orientation: 'landscape'
            } )
        ]
    } );
});

