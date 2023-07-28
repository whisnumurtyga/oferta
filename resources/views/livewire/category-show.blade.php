<div>
    @include('livewire.category-modal')
    {{-- Stop trying to control. --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
    </button>
    <div class="col-lg-6">
        <div class="table-user">
            <table class="table table-hover mx-auto mt-2">
                <thead class="sticky-top">
                    <tr class="text-center" style="background-color: #625757;">
                        <th scope="col" class="text-white">#</th>
                        <th scope="col" class="text-white">Name</th>
                        @if (Auth::user()->role_id <= 2)
                            <th scope="col" class="text-white">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->name }}</td>
                        @if (Auth::user()->role_id <= 2)
                        <td colspan="3" class="text-white">
                            <div class="row p-1 d-flex justify-content-center align-items-center">
                                <div class="col-4">
                                    <button type="button" class="btn btn-sm  btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal" wire:click.prevent="editCategory({{ $category->id }})">
                                        edit
                                    </button>
                                </div>
                                {{-- <div class="col-4">
                                    <a wire:click.prevent="deleteConfirmation({{ $category->id }})" class="btn btn-sm  btn-outline-danger delete-button" style="color:#625757">
                                        delete
                                    </a>
                                </div> --}}
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</div>

    {{-- Sweet Alert Delete Script --}}
    <script>
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this category?",
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

        window.addEventListener('category-deleted', event => {
            Swal.fire({
                title: 'Deleted',
                text: "category has been deleted",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>

    {{-- Sweet Alert Create Script --}}
    <script>
        window.addEventListener('category-added', event => {
            Swal.fire({
                title: 'Added',
                text: "Category has been added successfully!",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>

    {{-- Sweet Alert Update Script --}}
    <script>
        window.addEventListener('category-updated', event => {
            Swal.fire({
                title: 'Updated',
                text: "Category has been updated",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>
