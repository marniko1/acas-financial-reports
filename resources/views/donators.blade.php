@extends('layout')

@section('title', 'Donators')


@section('content')
    <table class="table table-bordered" id="donators-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>Monetary</th>
                <th>Non-Monetary</th>
                <th>Political Subject</th>
                <th>Election</th>
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
        processing: true,
        serverSide: true,
        ajax: '{!! route('donators') !!}',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'city', name: 'cities.name' },
            { data: 'monetary', name: 'mon.amount' },
            { data: 'nonmonetary', name: 'nonmon.amount' },
            { data: 'political_subject', name: 'political_subjects.name' },
            { data: 'election', name: 'elections.title' },
            { data: 'election_level', name: 'elections_levels.level' },
            { data: 'election_type', name: 'elections_types.type' },
        ]
    });
});
</script>
@endpush