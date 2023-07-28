<div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addCategoryModalLabel">Add Category</h1>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="addCategory" novalidate>
                    <div class="mb-1">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" wire:model="name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="addModalClosed">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@isset($oldCategory)

<div wire:ignore.self class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editCategoryModalLabel">Edit Category</h1>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateCategory" novalidate>
                    <div class="mb-1">
                        <label for="name" class="form-label">Name</label>
                        {{-- {{ dd($oldCategory) }} --}}
                        <input type="text" class="form-control" id="name" name="name" wire:model="edit_name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endisset
