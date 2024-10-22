$(document).ready(function(){
    $('#list-compact').DataTable({
        dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        // dom : '<t>'
    });
});

$(document).ready(function(){
    $('#list-compact2').DataTable({
        dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        // dom : '<"top"i>rt<"bottom"flp><"clear">'
    });
});

$(document).ready(function(){
    $('#pengunjung').DataTable({
        // dom: "<'contents-wrapper'  <'contents2-top' <'table-filter'<l>> <'table-search'<f>>>   <'contents2-mid' <'col-sm-12't>>   <'contents2-bottom' <'col-sm-6'i><'col-sm-6'p>> >"
        dom: "<'contents-wrapper'<'contents2-top'<'table-search'<f>><'table-filter'<l>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button'<p>>>>",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });
});

$(document).ready(function(){
    var table = $('#pengunjung-ext').DataTable({
        dom: "<'contents-wrapper-pengunjung'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button'<Bp>>>>",
        // dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
});

/////////////////////////////////////////////////////////////////

//LIST BUKU
$(document).ready(function(){
    $('#list-buku').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-listbuku'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            {
                text: 'Tambah Entri',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    // alert( 'Button activated' );
                    window.location.href = "list_buku_tambah.php";
                }
            },
            {
                extend: 'spacer',
                style: 'bar',
                text: '&nbsp;&nbsp;&nbsp;'
            },
            {
                text: 'Import Excel',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    window.location.href = "list_buku_import.php";
                }
            },
            {
                extend: 'spacer',
                style: 'bar',
                text: '&nbsp;&nbsp;&nbsp;'
            },
            {
                text: 'Export',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    window.location.href = "list_buku_export.php";
                }
            }
        ]
        
    });
});

//LIST BUKU - EXPORT
$(document).ready(function(){
    $('#list-buku-export').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-listbuku'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });
});

//LIST BUKU - IMPORT
$(document).ready(function(){
    $('#list-buku-import').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-listbuku'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            
        ]
        
    });
});

/////////////////////////////////////////////////////////////////

//MEMBER
$(document).ready(function(){
    $('#member').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-member'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            {
                text: 'Tambah Entri',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    // alert( 'Button activated' );
                    window.location.href = "member_tambah.php";
                }
            },
            {
                extend: 'spacer',
                style: 'bar',
                text: '&nbsp;&nbsp;&nbsp;'
            },
            {
                text: 'Import Excel',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    window.location.href = "member_import.php";
                }
            },
            {
                extend: 'spacer',
                style: 'bar',
                text: '&nbsp;&nbsp;&nbsp;'
            },
            {
                text: 'Export',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    window.location.href = "member_export.php";
                }
            }
        ]
        
    });
});

//MEMBER - Export
$(document).ready(function(){
    $('#member-export').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-member'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });
});
//MEMBER - Import
$(document).ready(function(){
    $('#member-import').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-member'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            
        ]
        
    });
});

/////////////////////////////////////////////////////////////////

//PEMINJAMAN
$(document).ready(function(){
    $('#peminjaman').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-member'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            {
                text: 'Pinjam Buku',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    // alert( 'Button activated' );
                    window.location.href = "peminjaman_tambah.php";
                }
            },
            {
                extend: 'spacer',
                style: 'bar',
                text: '&nbsp;&nbsp;&nbsp;'
            },
            {
                text: 'Export...',
                className: 'btn btn-dark',
                action: function ( e, dt, node, config ) {
                    window.location.href = "peminjaman_export.php";
                }
            }
        ]
        
    });
});

//PEMINJAMAN - Export
$(document).ready(function(){
    $('#peminjaman-export').DataTable({
        // dom: "<'row'<'col-9'f><'col-3 text-right'l>><'row'<'col-sm-12'tr>><'row'<'col-sm-6'i><'col-sm-6'p>>"
        dom: "<'contents-wrapper-member'<'contents2-top'<'table-filter'<l>><'table-search'<f>>><'contents2-mid'<t>><'contents2-bottom'<'table-info'<i>><'table-button-buku'<'div-button'<B>><'div-page'<p>>>>>",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });
});