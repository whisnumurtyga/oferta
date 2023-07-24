

<div>
    <div >
        {{-- {{ dd($suppliers) }} --}}
        @include("livewire.supplier-modal")
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
            Add Goods
        </button>
        <div class="">
            <div class="mt-2 py-3">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input  wire:model="search" type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="category_id_filter" name="category_id_filter" class="form-select custom-select" wire:model="category_id_filter" >
                                <option value="0" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="supplier_id_filter" name="supplier_id_filter" class="form-select custom-select" wire:model="supplier_id_filter" >
                                <option value="0" selected>Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-user">
                    <table class="table table-hover mx-auto mt-2">
                        <thead class="sticky-top">
                            <tr class="text-center" style="background-color: #625757;">
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Name</th>
                                <th scope="col" class="text-white">Category</th>
                                <th scope="col" class="text-white">Supplier</th>
                                <th scope="col" class="text-white">Stock</th>
                                <th scope="col" class="text-white">Buy</th>
                                <th scope="col" class="text-white">Sell</th>
                                <th scope="col" class="text-white">In</th>
                                <th scope="col" class="text-white">Exp</th>
                                <th scope="col" class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goods as $good)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $good->name }}</td>
                                        <td>{{ $good->categories->name }}</td>
                                        <td>{{ $good->suppliers->name }}</td>
                                        <td>{{ $good->stock }}</td>
                                        <td>{{ $good->buy }}</td>
                                        <td>{{ $good->sell }}</td>
                                        <td>{{ $good->date_in }}</td>
                                        <td>{{ $good->date_exp }}</td>
                                        <td colspan="3" class="text-white">
                                            <div class="row p-1 d-flex justify-content-center align-items-center">
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-sm  btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSupplierModal" wire:click.prevent="editSupplier()">
                                                        edit
                                                    </button>
                                                </div>
                                                <div class="col-4">
                                                    <a wire:click.prevent="deleteConfirmation()" class="btn btn-sm  btn-outline-danger delete-button" style="color:#625757">
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


