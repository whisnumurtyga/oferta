<div>
    <div>
        <div>
            <table class="table table-hover mt-5 py-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->role->role_name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td colspan="3">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button wire:click="openModal({{ $user->id }})" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" >
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" x-data="{ show: {{ $showModal ? 'true' : 'false' }} }" x-show="show" @keydown.escape.window="show = false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button wire:click="deleteUser" type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div>
         <button wire:click="deleteUser">DASDSA</button>
    </div>
</div>

