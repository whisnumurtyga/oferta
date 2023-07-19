<div>
    {{-- {{ dd($roles) }} --}}
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserModalLabel">Add User</h1>
                </div>
                <div class="modal-body">
                    <form wire:>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select id="role_id" name="role_id" class="form-select custom-select" wire:model.debounce.100000ms="role_id">
                                <option value="0" selected>Pilih Role</option>
                                @foreach ($roles as $role)
                                    @if ($role->role_name != "Owner")
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div id="role_id_error" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" wire:model.debounce.100000ms="name">
                            <div id="name_error" class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" wire:model.debounce.100000ms="username">
                            <div id="username_error" class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" wire:model.debounce.100000ms="email">
                            <div id="email_error" class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" wire:model.debounce.100000ms="password">
                            <div id="password_error" class="invalid-feedback"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="createUser">Add Data</button>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- <script>
    function validateAndCreateUser() {
        // Ambil nilai input dari formulir menggunakan JavaScript
        var role_id = document.getElementById('role_id').value;
        var name = document.getElementById('name').value;
        var username = document.getElementById('username').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Lakukan validasi menggunakan JavaScript
        if (role_id === '0') {
            role_id_error.textContent = 'Please select a role';
            role_id_error.style.display = 'block';
            return;
        } else {
            role_id_error.style.display = 'none';
        }

        if (name.trim() === '') {
            name_error.textContent = 'Name is required';
            name_error.style.display = 'block';
            return;
        }else {
            name_error.style.display = 'none';
        }

        if (username.trim() === '') {
            username_error.textContent = 'Username is required';
            username_error.style.display = 'block';
            return;
        } else {
            username_error.style.display = 'none';
        }


        if (email.trim() === '') {
            email_error.textContent = 'Email is required';
            email_error.style.display = 'block';
            return;
        } else {
            email_error.style.display = 'none';
        }

        if (password.trim() === '') {
            password_error.textContent = 'Email is required';
            password_error.style.display = 'block';
            return;
        } else {
            password_error.style.display = 'none';
        }

        // Lakukan aksi setelah validasi sukses, misalnya kirim data ke komponen Livewire
        Livewire.emit('createUser', role_id, name, username, email, password);
    }
</script> --}}
