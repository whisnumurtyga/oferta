<div >
    {{ $search }}
    {{-- {{ dd($users) }} --}}
    <div class="">
        <div class="mt-2 py-3">
            <input  wire:model="search" type="text" class="form-control" placeholder="Search">
            {{-- {{ $search }} --}}
            <table class="table table-hover mx-auto mt-2">
                <thead>
                    <tr class="primary">
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="">Action</th>
                    </tr>
                </thead>
                <div class="d-flex justify-content-center">
                    {{ $users->links('vendor.pagination.custom-pagination') }}
                </div>
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
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td colspan="3">
                                <div class="row p-1">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-outline-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-outline-warning">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <a wire:click.prevent="deleteConfirmation({{ $user->id }})" class="btn btn-outline-danger delete-button">
                                            <i class="bi bi-trash-fill"></i>
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


    </div>

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

