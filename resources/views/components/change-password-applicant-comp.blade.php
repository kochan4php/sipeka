<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changePasswordLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('change.password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row custom-font">
                        <label for="old_password" class="col-sm-4 col-form-label text-md-end">
                            {{ __('Password lama') }}
                        </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                    </div>
                    <div class="mb-3 row custom-font">
                        <label for="new_password" class="col-sm-4 col-form-label text-md-end">
                            {{ __('Password baru') }}
                        </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                    </div>
                    <div class="mb-3 row custom-font">
                        <label for="new_password_confirmation" class="col-sm-4 col-form-label text-md-end">
                            {{ __('Konfirmasi password baru') }}
                        </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn custom-btn btn-primary">Perbarui Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
