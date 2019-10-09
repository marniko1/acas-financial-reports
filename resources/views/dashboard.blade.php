@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Button trigger modal -->
                    @if (Auth::user()->admin)
                        <button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#addUserModal">
                            Add new user
                        </button>

                        <div class="table-wrapper col-12 mt-5">
                            <table id="users-table" class="table table-sm p-0 table-hover font-s display nowrap" width="100%">
                                <caption>List of users</caption>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Admin</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Admin</th>
                                        <th>Options</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif

                </div>
            </div>


            @include('inc.modals.register_modal')
            @include('inc.modals.edit_modal')
            @include('inc.modals.delete_user_modal')


        </div>
    </div>
</div>
@stop

@push('scripts')

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script>
        jQuery(document).ready(function(){

            let table = $('#users-table').DataTable({
                dom: 'Bft',
                processing: true,
                serverSide: true,
                ajax: '{!! url('/users') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'username', name: 'username' },
                    { data: 'email', name: 'email' },
                    { data: 'admin', name: 'admin', render: function (data) { return data == true } },
                    {   data: 'id', 
                        name: 'options', 
                        render: function (data) { 
                            return `<div class="editDeleteWrapp" data-id="${data}"><small><a class="edit" href="#" data-toggle="modal" data-target="#editUserModal">Edit</a></small><small> / </small><small><a class="delete" href="#" data-toggle="modal" data-target="#removeUserModal">Delete</a></small></div>`
                        }
                    },
                ]
            });

            $('#ajaxSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/users') }}",
                    method: 'POST',
                    data: {
                        name: jQuery('#name').val(),
                        username: jQuery('#username').val(),
                        email: jQuery('#email').val(),
                        password: jQuery('#password').val(),
                        password_confirmation: jQuery('#password-confirmation').val(),
                    },
                    success: function(result){

                        if(result.errors)
                        {

                            $('div.form-group input.form-control').removeClass('is-invalid');
                            $('div.form-group span.invalid-feedback').remove();

                            $.each(result.errors, function(key, value){

                                $('#' + key).addClass('is-invalid');
                                $('#' + key).after(`<span class="invalid-feedback" role="alert">
                                                        <strong>${value[0]}</strong>
                                                    </span>`);
                                $('span.invalid-feedback').show();
                            });
                        }
                        else
                        {
                        
                            $('div.form-group input.form-control').removeClass('is-invalid');
                            $('div.form-group input.form-control').val('');
                            $('div.form-group span.invalid-feedback').remove();
                            $('div.card-body button').before(`<div class="alert alert-success" role="alert">
                                                        ${result.success}
                                                    </div>`);
                            $('#open').hide();
                            $('#addUserModal').modal('hide');

                            refreashTable(table);
                        }
                    }
                });
            });




            $('#ajaxEditSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/users') }}" + "/" + $('#edit-user-id').val(),
                    type: 'PATCH',
                    data: {
                        name: $('#edit_name').val(),
                        username: $('#edit_username').val(),
                        email: $('#edit_email').val(),
                        password: $('#edit_password').val(),
                        password_confirmation: $('#edit_password_confirmation').val(),
                    },
                    success: function(result){
                        console.log(result);
                        if(result.errors)
                        {

                            $('#editUserModal div.form-group input.form-control').removeClass('is-invalid');
                            $('#editUserModal div.form-group span.invalid-feedback').remove();

                            $.each(result.errors, function(key, value){

                                console.log(key);

                                $('#editUserModal #edit_' + key).addClass('is-invalid');
                                $('#editUserModal #edit_' + key).after(`<span class="invalid-feedback" role="alert">
                                                        <strong>${value[0]}</strong>
                                                    </span>`);
                                $('#editUserModal span.invalid-feedback').show();
                            });
                        }
                        else
                        {
                        
                            $('#editUserModal div.form-group input.form-control').removeClass('is-invalid');
                            $('#editUserModal div.form-group input.form-control').val('');
                            $('#editUserModal div.form-group span.invalid-feedback').remove();
                            $('div.card-body button').before(`<div class="alert alert-success" role="alert">
                                                        ${result.success}
                                                    </div>`);
                            $('#editUserModal #open').hide();
                            $('#editUserModal').modal('hide');

                            refreashTable(table);
                        }
                    }
                });
            });




            $('#ajaxDeleteUserSubmit').click(function(e) {

                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/users') }}" + "/" + $('#delete-user-id').val(),
                    type: 'DELETE',
                    success: function(result){

                        $('div.card-body button').before(`<div class="alert alert-success" role="alert">
                                                    ${result.success}
                                                </div>`);
                        $('#removeUserModal').modal('hide');

                        refreashTable(table);
                    }
                });
            });



            $('body').click('.editDeleteWrapp .delete', function(e) {
                if ($(e.target).hasClass('delete')) {
                    e.preventDefault();

                    let id = $(e.target).parents('.editDeleteWrapp').data('id');

                    $('#delete-user-id').remove();
                    $('#removeUserModal .modal-body').after(`<input type="hidden" id="delete-user-id" name="id" value="${id}">`);
                }
            });





            $('body').click('.editDeleteWrapp .edit', function (e) {
                

                if ($(e.target).hasClass('edit')) {
                e.preventDefault();

                    let password = table.row($(e.target).parents('tr')).data().password;

                    let id = $(e.target).parents('.editDeleteWrapp').data('id');

                    let tds = $(e.target).parents('tr').find('td');
                    let inputs = $('#editUserModal').find('input');

                    let name_td = tds[0];
                    let name_input = inputs[2];

                    let username_td = tds[1];
                    let username_input = inputs[3];

                    let email_td = tds[2];
                    let email_input = inputs[4];

                    let password_input = inputs[5];
                    let password_confirmation_input = inputs[6];

                    $(name_input).val($(name_td).text());
                    $(username_input).val($(username_td).text());
                    $(email_input).val($(email_td).text());
                    $(password_input).val(password);
                    $(password_confirmation_input).val(password);
                    $('#edit-user-id').remove();
                    $(password_confirmation_input).after(`<input type="hidden" id="edit-user-id" name="id" value="${id}">`);
                }


            });

            function refreashTable(table) {

                table.clear().draw();
                table.columns.adjust().draw(); // Redraw the DataTable
            }
        });
    </script>

@endpush