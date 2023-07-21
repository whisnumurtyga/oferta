<div>
    {{-- TODO ==> INSERT MODAL <=== --}}
    <div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{-- @if ($errors->any())
                {{ dd($errors) }}
            @endif --}}
            {{-- @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserModalLabel">Add User</h1>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addUser" novalidate>
                        <div class="mb-1">
                            <label for="role_id" class="form-label">Role</label>
                            <select id="role_id" name="role_id" class="form-select custom-select" wire:model="role_id">
                                <option value="0" selected>Pilih Role</option>
                                @foreach ($roles as $role)
                                    @if ($role->role_name != "Owner")
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('role_id') && ($role_id == 0))
                                <span class="text-danger">{{ $errors->first('role_id') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" wire:model="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" wire:model="username">
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" wire:model="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" wire:model="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="AddModalClosed">Close</button>
                            <button type="submit" class="btn btn-primary">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Todo DELETE MODAL --}}
    <div>
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete?
                    </div>
                    <div class="modal-footer">
                        <button wire:click="deleteMember" type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--


    {{-- TODO ==> EDIT MODAL <=== --}}
    {{-- {{ dd($user) }} --}}
    <div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{-- @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateUserModalLabel">Edit User</h1>
                </div>
                <div class="modal-body">
                    @if ($editModalClicked)
                    <form wire:submit.prevent="updateUser" novalidate>
                        <div class="mb-1">
                            <label for="new_role_id" class="form-label">Role</label>
                            <select id="new_role_id" name="new_role_id" class="form-select custom-select" wire:model="new_role_id">
                                <option value="0" selected>Pilih Role</option>
                                @foreach ($roles as $role)
                                    @if ($role->role_name != "Owner")
                                        <option value="{{ $role->id }}" @if ($role->id == $userUpdate->role_id ) selected @endif>{{ $role->role_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('new_role_id') && ($role_id == 0))
                                <span class="text-danger">{{ $errors->first('new_role_id') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="new_name" name="new_name" wire:model="new_name">
                            @if ($errors->has('new_name'))
                                <span class="text-danger">{{ $errors->first('new_name') }}</span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <label for="new_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="new_username" name="new_username" wire:model="new_username">
                            @if ($errors->has('new_username'))
                                <span class="text-danger">{{ $errors->first('new_username') }}</span>
                            @endif
                        </div>

                        <div class="mb-1">
                            <label for="new_email" class="form-label">Email</label>
                            <input type="new_email" class="form-control" id="new_email" name="new_email" wire:model="new_email">
                            @if ($errors->has('new_email'))
                                <span class="text-danger">{{ $errors->first('new_email') }}</span>
                            @endif
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="editModalClosed">Close</button>
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>







 --}}


























</div>
