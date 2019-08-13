@extends('layout')

@section('title', 'Donators')


@section('content')
    <table class="table table-sm p-0 display" id="donators-table" style="width: 100%">
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
@stop

@push('scripts')
<script>
$(function() {
    var table = $('#donators-table').DataTable({
        "language": {
            "decimal": ",",
            "thousands": "."
        },
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
        ],
    });
});
</script>
@endpush