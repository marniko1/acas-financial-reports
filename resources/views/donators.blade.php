@extends('layouts.app')

@section('title', 'Donators')


@section('content')
    <div class="container-fluid py-4">
                <div class="row">
                    <div class="table-wrapper col-12 mt-5">
                        <table class="table table-sm p-0 table-hover display" id="donators-table" style="width: 100%">
                            <caption>List of donators</caption>
                            <thead>
                                <tr style="white-space: nowrap;">
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
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script>
$(function() {
    var table = $('#donators-table').DataTable({
        "language": {
            "decimal": ",",
            "thousands": "."
        },
        select: true,
        dom: '<"col-12"B<"toggle-wrapper col-12"><"col-6 float-left px-0"l><"col-6 float-right px-0"f>rtip>',
        buttons: {
            dom: {
                container: {
                    className: 'col-12 mb-5'
                }
            },
            buttons: [
                { 
                    extend: 'copyHtml5', className: 'btn btn-info', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', exportOptions: { columns: ':visible' } 
                },
                { 
                    extend: 'csvHtml5', className: 'btn btn-success', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', exportOptions: { columns: ':visible' }  
                },
                { 
                    extend: 'excelHtml5', className: 'btn btn-success', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', exportOptions: { columns: ':visible' }  
                },
                { 
                    extend: 'pdfHtml5', className: 'btn btn-danger', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', exportOptions: { columns: ':visible' }  
                },
                { 
                    extend: 'print', className: 'btn btn-secondary', text: '<i class="fa fa-print" aria-hidden="true"></i>', titleAttr: 'Print', exportOptions: { columns: ':visible' }  
                }
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
        ],
    });
    $('#donators-table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
});
</script>
@endpush