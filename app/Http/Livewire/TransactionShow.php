<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Good;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionShow extends Component
{
    public $search, $supplier_id_filter, $category_id_filter, $price_filter;
    public $qty, $transaction;
    protected $listeners = [
        'addDetailTransaction' => 'addDetailTransaction'
    ];

    public function render()
    {
        return view('livewire.transaction-show', [
            'goods' => $this->getGoods(),
            'suppliers' => Supplier::all(),
            'categories' => Category::all()
        ]);
    }


    public function getGoods()
    {
        $query = Good::with(['categories', 'suppliers']);

        // Filter berdasarkan supplier_id
        if ($this->supplier_id_filter > 0) {
            $query->where('supplier_id', $this->supplier_id_filter);
        }

        // Filter berdasarkan category_id
        if ($this->category_id_filter > 0) {
            $query->where('category_id', $this->category_id_filter);
        }

        // Filter berdasarkan pencarian (search)
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        // Sorting berdasarkan harga (price)
        if ($this->price_filter == 1) {
            $query->orderBy('sell', 'desc');
        } else {
            $query->orderBy('sell', 'asc');
        }

        $goods = $query->get();

        return $goods;
    }

    public function getTransaction($userId)
    {
        $transaction = Transaction::when('user_id', $userId);
    }

    public function addDetailTransaction($goodId, $qty)
    {
        // dd('sad');
        if($qty != 0 && $qty != "") {
            dd($goodId, $qty, Auth::user()->id);
        }
        // $this->cart[$productId] = $quantity; // Menambahkan barang dan jumlahnya ke dalam array cart
    }

}
