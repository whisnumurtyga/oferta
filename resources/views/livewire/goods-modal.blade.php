<div>
    {{-- {{ dd($categories) }} --}}
    {{-- {{ dd($goods) }} --}}
    {{-- TODO ==> INSERT MODAL <=== --}}
    <div wire:ignore.self class="modal fade" id="addGoodsModal" tabindex="-1" aria-labelledby="addGoodsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addGoodsModalLabel">Add Goods</h1>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addGoods" novalidate>
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" wire:model="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="category_id" class="form-label">Category</label>
                            <select id="category_id" name="category_id" class="form-select custom-select" wire:model="category_id">
                                <option value="0" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id') && ($category_id == 0))
                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select id="supplier_id" name="supplier_id" class="form-select custom-select" wire:model="supplier_id">
                                <option value="0" selected>Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('supplier->id') && ($supplier->id == 0))
                                <span class="text-danger">{{ $errors->first('supplier->id') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" wire:model="stock">
                            @if ($errors->has('stock'))
                                <span class="text-danger">{{ $errors->first('stock') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="buy" class="form-label">Buy</label>
                            <input type="text" class="form-control" id="buy" name="buy" wire:model="buy">
                            @if ($errors->has('buy'))
                                <span class="text-danger">{{ $errors->first('buy') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="sell" class="form-label">Sell</label>
                            <input type="text" class="form-control" id="sell" name="sell" wire:model="sell">
                            @if ($errors->has('sell'))
                                <span class="text-danger">{{ $errors->first('sell') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="date_in" class="form-label">Date In</label>
                            <input type="date" class="form-control" id="date_in" name="date_in" wire:model="date_in">
                            @if ($errors->has('date_in'))
                                <span class="text-danger">{{ $errors->first('date_in') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="date_exp" class="form-label">Date Exp</label>
                            <input type="date" class="form-control" id="date_exp" name="date_exp" wire:model="date_exp">
                            @if ($errors->has('date_exp'))
                                <span class="text-danger">{{ $errors->first('date_exp') }}</span>
                            @endif
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="addModalClosed">Close</button>
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
                        <button wire:click="deleteGoods" type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- TODO ==> EDIT MODAL <=== --}}

    <div wire:ignore.self class="modal fade" id="editGoodsModal" tabindex="-1" aria-labelledby="editGoodsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editGoodsModalLabel">Edit Goods</h1>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateGoods" novalidate>
                        <div class="mb-1">
                            <label for="new_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="new_name" name="new_name" wire:model="new_name">
                            @if ($errors->has('new_name'))
                                <span class="text-danger">{{ $errors->first('new_name') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_category_id" class="form-label">Category</label>
                            <select id="new_category_id" name="new_category_id" class="form-select custom-select" wire:model="new_category_id">
                                <option value="0" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('new_category_id') && ($category_id == 0))
                                <span class="text-danger">{{ $errors->first('new_category_id') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_supplier_id" class="form-label">Supplier</label>
                            <select id="new_supplier_id" name="new_supplier_id" class="form-select custom-select" wire:model="new_supplier_id">
                                <option value="0" selected>Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('new_supplier->id') && ($supplier->id == 0))
                                <span class="text-danger">{{ $errors->first('new_supplier->id') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="new_stock" name="new_stock" wire:model="new_stock">
                            @if ($errors->has('new_stock'))
                                <span class="text-danger">{{ $errors->first('new_stock') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_buy" class="form-label">Buy</label>
                            <input type="text" class="form-control" id="new_buy" name="new_buy" wire:model="new_buy">
                            @if ($errors->has('new_buy'))
                                <span class="text-danger">{{ $errors->first('new_buy') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_sell" class="form-label">Sell</label>
                            <input type="text" class="form-control" id="new_sell" name="new_sell" wire:model="new_sell">
                            @if ($errors->has('new_sell'))
                                <span class="text-danger">{{ $errors->first('new_sell') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_date_in" class="form-label">Date In</label>
                            <input type="date" class="form-control" id="new_date_in" name="new_date_in" wire:model="new_date_in">
                            @if ($errors->has('new_date_in'))
                                <span class="text-danger">{{ $errors->first('new_date_in') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="new_date_exp" class="form-label">Date Exp</label>
                            <input type="date" class="form-control" id="new_date_exp" name="new_date_exp" wire:model="new_date_exp">
                            @if ($errors->has('new_date_exp'))
                                <span class="text-danger">{{ $errors->first('new_date_exp') }}</span>
                            @endif
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="editModalClosed">Close</button>
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






























</div>
