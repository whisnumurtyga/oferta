<div>
    {{-- TODO ==> INSERT MODAL <=== --}}
    <div wire:ignore.self class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addSupplierModalLabel">Add Supplier</h1>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addSupplier" novalidate>
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" wire:model="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" wire:model="phone">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" wire:model="address">
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
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
                        <button wire:click="deleteSupplier" type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- TODO ==> EDIT MODAL <=== --}}

    <div wire:ignore.self class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSupplierModalLabel">Edit Supplier</h1>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateSupplier" novalidate>
                        <div class="mb-1">
                            <label for="new_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="new_name" name="new_name" wire:model="new_name">
                            @if ($errors->has('new_name'))
                                <span class="text-danger">{{ $errors->first('new_name') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="new_phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="new_phone" name="new_phone" wire:model="new_phone">
                            @if ($errors->has('new_phone'))
                                <span class="text-danger">{{ $errors->first('new_phone') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="new_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="new_address" name="new_address" wire:model="new_address">
                            @if ($errors->has('new_address'))
                                <span class="text-danger">{{ $errors->first('new_address') }}</span>
                            @endif
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="editModalClosed">Close</button>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






























</div>
