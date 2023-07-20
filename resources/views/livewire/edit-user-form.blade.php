<div>
    {{-- {{ dd($roles) }} --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">Detail User</h1>
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
                    <button type="button" class="btn btn-primary" wire:click="createUser">Detail Data</button>
                </div>
            </div>
        </div>
    </div>
</div>

