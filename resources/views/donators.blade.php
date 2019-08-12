@extends('layout')

@section('title', 'Donators')


@section('content')
    <table class="table table-sm table-hover table-striped px-0" id="donators-table" style="width: 100%">
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
    $('#donators-table').DataTable({
        dom: '<"col-12"B<"col-6 float-left px-0"l><"col-6 float-right px-0"f>rtip>',
        buttons: {
            dom: {
                container: {
                    className: 'col-12 mb-5'
                }
            },
            buttons: [
                { extend: 'copy', className: 'btn btn-info' },
                { extend: 'csv', className: 'btn btn-success' },
                { extend: 'excel', className: 'btn btn-success' },
                { extend: 'pdf', className: 'btn btn-danger' },
                { extend: 'print', className: 'btn btn-secondary' },
            ],
        },
        lengthMenu: [
            // [ 10, 25, 50, -1 ],
            [ 10, 25, 50, 100 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows' ]
        ],
        columnDefs: [
            // { className: "red", targets: "_all" },
            // {  className: "red", targets: 1 }
        ],
        processing: true,
        serverSide: true,
        ajax: '{!! route('donators') !!}',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'city', name: 'city' },
            { data: 'monetary', name: 'monetary' },
            { data: 'nonmonetary', name: 'nonmonetary' },
            { data: 'report_year', name: 'report_year' },
            { data: 'political_subject', name: 'political_subject' },
            { data: 'election', name: 'election' },
            { data: 'election_year', name: 'election_year' },
            { data: 'election_level', name: 'election_level' },
            { data: 'election_type', name: 'election_type' },
        ]
    });
});
</script>
@endpush