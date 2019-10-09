<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- <div class="alert alert-danger" style="display:none"></div> --}}
            <form method="POST" action="{{ url('/users') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLongTitle">{{ __('Edit user') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @method('PATCH')
                    @csrf

                    <div class="form-group row">
                        <label for="edit_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="edit_name" type="text" class="form-control @error('edit_name') is-invalid @enderror" name="edit_name" value="{{ old('edit_name') }}" required autocomplete="edit_name" autofocus>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="edit_username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="edit_username" type="text" class="form-control @error('edit_username') is-invalid @enderror" name="edit_username" value="{{ old('edit_username') }}" required autocomplete="edit_username" autofocus>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="edit_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="edit_email" type="email" class="form-control @error('edit_email') is-invalid @enderror" name="edit_email" value="{{ old('edit_email') }}" required autocomplete="edit_email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="edit_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="edit_password" type="password" class="form-control @error('edit_password') is-invalid @enderror" name="edit_password" required autocomplete="new-password" value="{{ old('edit_password') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="edit_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="edit_password_confirmation" type="password" class="form-control" name="edit_password_confirmation" required autocomplete="new-password" value="{{ old('edit_password_confirmation') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary" id="ajaxEditSubmit">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>