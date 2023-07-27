<div>
    {{-- {{ dd($goods) }} --}}
    {{-- The best athlete wants his opponent at his best. --}}
    {{-- {{ dd($cart) }} --}}
    <div class="mt-5 container">
        <h1 class="text-lg text-primary text-center font-bold" style="font-size: 32px; letter-spacing: 3px;">PRODUK</h1>
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6">
                        <input  wire:model="search" type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="category_id_filter" name="category_id_filter" class="form-select custom-select" wire:model="category_id_filter" >
                                <option value="0" selected>Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="supplier_id_filter" name="supplier_id_filter" class="form-select custom-select" wire:model="supplier_id_filter" >
                                <option value="0" selected>Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="price_filter" name="price_filter" class="form-select custom-select" wire:model="price_filter" >
                                <option value="0" selected>Price</option>
                                <option value="1" selected>Highest</option>
                                <option value="0" selected>Lowest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-8">
                <?php
                    $keyword = array(
                        "food", "drink", "pizza", "coffee", "sushi", "ice crea ",
                        "fruit", "smoothie", "pasta", "burger", "rice cooked", "fried chicken",
                        "hotdog", "soup", "kebab", "taco", "puding", "nugget", "tiramisu", "dimsum"
                    );
                ?>


            <!-- Misalkan Anda sudah memiliki data $products dari controller -->
            @foreach ($goods as $good)
                @if ($loop->index % 4 === 0)
                    <div class="row mb-4">
                @endif

                <div class="col-lg-3">
                    <div class="card" style="width: 14rem;">
                        <span class="category">{{ $good->categories->name }}</span>
                        <img src="https://source.unsplash.com/200x150?{{ $keyword[array_rand($keyword)] }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h1 class="card-title text-center fw-bolder text-primary" style="font-weight: 600; font-size:20px">{{ $good->name }}</h1>
                            <p class="card-text text-center" style="font-weight: bold; font-size: 18px; margin-top: -8px">Rp{{ $good->sell }}</p>
                            <div class="row mt-2">
                                <div class="col-lg-7">
                                    <input id="quantity_{{ $good->id }}" type="number" class="form-control">
                                </div>
                                <div class="col-lg-5">
                                    <button onclick="addDetailTransaction({{ $good->id }})" class="btn btn-primary">Add</button>
                                   {{-- <button wire:click="addDetailTransaction({{ $good->id }}, {{ $good->id }})" class="btn btn-primary">Add</button> --}}
                                    {{-- {{ $cart[$good->id] }}
                                    {{ $good->id }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @if (($loop->index + 1) % 4 === 0 || $loop->last)
                    </div>
                @endif
            @endforeach
            </div>
            <button class="btn btn-outline-primary">History Transactions</button>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header" style="font-weight:500; font-size:20px">
                      Detail Transaksi
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-lg-1">1</div>
                            <div class="col-lg-5">Coki-Coki</div>
                            <div class="col-lg-2">3</div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        Rp 12.000
                                    </div>
                                    <div class="col-lg-4" style="margin-top: -5px">
                                        <button class="btn btn-outline-primary btn-sm btn-round "><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-1">2</div>
                            <div class="col-lg-5">Kopi Susu</div>
                            <div class="col-lg-2">1</div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        Rp 10.000
                                    </div>
                                    <div class="col-lg-4" style="margin-top: -5px">
                                        <button class="btn btn-outline-primary btn-sm btn-round "><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row" style="font-weight:600; font-size:16px">
                            <div class="col-lg-3">Total</div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">Rp 1.247.000</div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg mt-1 col-lg-12">Submit Order</button>
            </div>
        </div>
    </div>
</div>


<script>
    function addDetailTransaction(goodId) {
        // Dapatkan nilai dari input menggunakan ID
        var quantity = document.getElementById('quantity_' + goodId).value;

        // Panggil fungsi Livewire dengan nilai yang diperoleh dari input
        Livewire.emit('addDetailTransaction', goodId, quantity);
        // alert(goodId)
        // alert(quantity)
    }
</script>
