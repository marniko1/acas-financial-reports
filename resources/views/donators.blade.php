@extends('layouts.app')

@section('title', 'Donators')


@section('content')

    <div class="container-fluid py-4">
                <div class="row">

    {{-- <div class="search-wrapper">
        <input type="text" placeholder="Search...">
        <div class="search"></div>
    </div> --}}
                    <div class="table-wrapper col-12 mt-5">
                        <table id="donators-table" class="table table-sm p-0 table-hover font-s display nowrap" width="100%">
                            <caption>List of donators</caption>
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>City</th>
                                    <th>Monetary</th>
                                    <th>Non-Monetary</th>
                                    <th>Report Year</th>
                                    <th>Political Subject</th>
                                    <th>Election</th>
                                    <th>Election Year</th>
                                    <th>Election Level</th>
                                    <th>Election Type</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>City</th>
                                <th>Monetary</th>
                                <th>Non-Monetary</th>
                                <th>Report Year</th>
                                <th>Political Subject</th>
                                <th>Election</th>
                                <th>Election Year</th>
                                <th>Election Level</th>
                                <th>Election Type</th>
                            </tfoot>
                        </table>
                    </div>
            </div>
        </div>
@stop

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#donators-table').DataTable({
        responsive: true,
        fixedHeader: true,
        "language": {
            decimal: ",",
            thousands: ".",
            searchPlaceholder: "Search records",
            search: "",
        },
        select: {
            style: 'multi'
        },
        dom: '<"col-12 mx-0 row"<"col-12 mb-5 bg-info row py-4 rounded mx-0 font-weight-bold"B<"col-lg-3 float-right px-0"<"search-wrapper">>><"small col-12  mb-5" i<"float-right"p>>rt<"small col-12" i<"col-6 float-right"p>>>',
        buttons: {
            dom: {
                container: {
                    className: 'col-lg-9 p-0'
                }
            },
            buttons: [
                { 
                    extend: 'copyHtml5', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: { columns: ':visible' } 
                },
                { 
                    extend: 'csvHtml5', className: 'text-success', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', exportOptions: { columns: ':visible' }  
                },
                { 
                    extend: 'excelHtml5', className: 'text-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: { columns: ':visible' }  
                },
                { 
                    extend: 'pdfHtml5', className: 'text-danger', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', exportOptions: { columns: ':visible' }  
                },
                { 
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    exportOptions: { 
                        columns: ':visible', 
                        rows: function (idx, data, node) {
                            var dt = new $.fn.dataTable.Api('#example' );
                            var selected = dt.rows( { selected: true } ).indexes().toArray();
                           
                            if( selected.length === 0 || $.inArray(idx, selected) !== -1)
                              return true;
                      

                            return false;
                        }
                    }  
                },
                { 
                    extend: 'pageLength',
                    className: 'ml-1 ml-md-5 font-weight-bold'
                },
                { 
                    extend: 'selectNone',
                    className: 'ml-md-5 font-weight-bold'
                },
                { 
                    extend: 'colvis',
                    className: 'ml-md-1 font-weight-bold'
                },
            ],
        },
        lengthMenu: [
            [ 10, 25, 50, 100 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows' ]
        ],
        processing: true,
        serverSide: true,
        ajax: '{!! route('donators') !!}',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'city', name: 'city' },
            { data: 'monetary', name: 'monetary', render: $.fn.dataTable.render.number( '.', ',', 2,) },
            { data: 'nonmonetary', name: 'nonmonetary', render: $.fn.dataTable.render.number( '.', ',', 2)  },
            { data: 'report_year', name: 'report_year' },
            { data: 'political_subject', name: 'political_subject' },
            { data: 'election', name: 'election' },
            { data: 'election_year', name: 'election_year' },
            { data: 'election_level', name: 'election_level' },
            { data: 'election_type', name: 'election_type' },
        ]
    });
    $("div.search-wrapper").html('<input type="search" id="search-input" placeholder="Search..." aria-controls="donators-table"><div class="search"></div>');
    $('#search-input').keyup(function(){
        table.search($(this).val()).draw() ;
    });
});
</script>
@endpush