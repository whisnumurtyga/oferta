<div >
    {{-- {{ $search }} --}}
    {{-- {{ dd($users) }} --}}

    <div class="">
        <div class="mt-2 py-3">
            <div class="row">
                <div class="col-lg-5">
                    <input  wire:model="search" type="text" class="form-control" placeholder="Search">
                </div>
                <div class="col-lg-2">
                    <div class="">
                        <select id="role_id" name="role_id" class="form-select custom-select" wire:model="role_id" wire:change="getAllUsers">
                            <option value="0" selected>Pilih Role</option>
                            @foreach ($roles as $role)
                                @if ($role->role_name != "Owner")
                                    <option value="{{ $role->id }}" ">{{ $role->role_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {{-- <input  wire:model="search" type="text" class="form-control" placeholder="Search"> --}}
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-center">
                        {{ $users->links('vendor.pagination.custom-pagination') }}
                    </div>
                </div>
            </div>
            {{-- {{ $search }} --}}
            <table class="table table-hover mx-auto mt-2">
                <thead>
                    <tr class="text-center" style="background-color: #625757;">
                        <th scope="col" class="text-white">#</th>
                        <th scope="col" class="text-white">Role</th>
                        <th scope="col" class="text-white">Name</th>
                        {{-- <th scope="col" class="text-white">Username</th>
                        <th scope="col" class="text-white">Email</th> --}}
                        <th scope="col" class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{ dd($users) }} --}}
                    @foreach ($users as $index => $user)
                        @php
                        $iteration = ($users->currentPage() - 1) * $users->perPage() + $index + 1;
                        @endphp
                        <tr>
                            <th scope="row">{{ $iteration }}</th>
                            <td>{{ $user->role->role_name }}</td>
                            <td>{{ $user->name }}</td>
                            {{-- <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td> --}}
                            <td colspan="3" class="text-white">
                                <div class="row p-1 d-flex justify-content-center align-items-center">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-sm  btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailUserModal" wire:click.prevent="toggleModal({{ $user->id }})">
                                            detail
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm  btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editUserModal" >
                                            edit
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <a wire:click.prevent="deleteConfirmation({{ $user->id }})" class="btn btn-sm  btn-outline-danger delete-button" style="color:#625757">
                                            {{-- <i class="bi bi-trash-fill"></i> --}}
                                            delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    @livewire('edit-user-form')
    @livewire('detail-user-form')

</div>


{{-- Sweet Alert Delete Script --}}
<script>
    window.addEventListener('show-delete-confirmation', event => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You woant to delete this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#625757',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sure'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteConfirmed')
            }
        })
    })

    window.addEventListener('user-deleted', event => {
        Swal.fire({
            title: 'Deleted',
            text: "User has been deleted",
            icon: 'success',
            confirmButtonColor: '#625757',
            confirmButtonText: 'Ok'
        })
    })
</script>

{{-- Sweet Alert Create Script --}}
<script>
    window.addEventListener('create-user-alert', event => {
        Swal.fire({
            title: 'Added',
            text: "User has been added successfully!",
            icon: 'success',
            confirmButtonColor: '#625757',
            confirmButtonText: 'Ok'
        })
    })
</script>

