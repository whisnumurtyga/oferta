

<div>
    <div >
        {{-- {{ dd($suppliers) }} --}}
        @include("livewire.supplier-modal")
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
            Add Supplier
        </button>
        <div class="">
            <div class="mt-2 py-3">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input  wire:model="search" type="text" class="form-control" placeholder="Search">
                    </div>
                <div class="table-user">
                    <table class="table table-hover mx-auto mt-2">
                        <thead class="sticky-top">
                            <tr class="text-center" style="background-color: #625757;">
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Name</th>
                                <th scope="col" class="text-white">Phone</th>
                                <th scope="col" class="text-white">Address</th>
                                @if (Auth::user()->role_id <= 2)
                                    <th scope="col" class="text-white">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supp)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $supp->name }}</td>
                                        <td>{{ $supp->phone }}</td>
                                        <td>{{ $supp->address }}</td>
                                        @if (Auth::user()->role_id <= 2)
                                            <td colspan="3" class="text-white">
                                                <div class="row p-1 d-flex justify-content-center align-items-center">
                                                    <div class="col-4">
                                                        <button type="button" class="btn btn-sm  btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSupplierModal" wire:click.prevent="editSupplier({{ $supp->id }})">
                                                            edit
                                                        </button>
                                                    </div>
                                                    <div class="col-4">
                                                        <a wire:click.prevent="deleteConfirmation({{ $supp->id }})" class="btn btn-sm  btn-outline-danger delete-button" style="color:#625757">
                                                            delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
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
                text: "You want to delete this supplier?",
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

        window.addEventListener('supplier-deleted', event => {
            Swal.fire({
                title: 'Deleted',
                text: "supplier has been deleted",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>

    {{-- Sweet Alert Create Script --}}
    <script>
        window.addEventListener('create-supplier-alert', event => {
            Swal.fire({
                title: 'Added',
                text: "Supplier has been added successfully!",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>

    {{-- Sweet Alert Update Script --}}
    <script>
        window.addEventListener('supplier-updated', event => {
            Swal.fire({
                title: 'Updated',
                text: "Supplier has been updated",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>


