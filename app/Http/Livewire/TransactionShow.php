<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\DetailTransaction;
use App\Models\Good;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionShow extends Component
{
    public $search, $supplier_id_filter, $category_id_filter, $price_filter;
    public $qty, $transaction, $detailTransactions, $detail_member, $detail_payment;

    protected $listeners = [
        'addDetailTransaction' => 'addDetailTransaction'
    ];

    public function render()
    {
        return view('livewire.transaction-show', [
            'goods' => $this->getGoods(),
            'members' => Member::all(),
            'suppliers' => Supplier::all(),
            'payments' => Payment::all(),
            'categories' => Category::all(),
            'transaction' => $this->getTransaction(),
            'detailTransaction' => $this->getDetailTransaction($this->getTransaction()->id)
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
        } else if($this->price_filter == 2) {
            $query->orderBy('sell', 'asc');
        }

        $goods = $query->get();

        return $goods;
    }

    public function getTransaction()
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('status_id', 1)->first();
        return $transaction;
    }

    public function getDetailTransaction($transactionId)
    {
        $detailTransaction = DetailTransaction::where('transaction_id', $transactionId)->get();
        return $detailTransaction;
    }
    public function addDetailTransaction($goodId, $qty)
    {
        // dd('sad');
        if($qty != 0 && $qty != "") {
            $this->transaction = $this->getTransaction();
            // dd($this->transaction->id);
            if($this->transaction != null) {
                $this->getDetailTransaction($this->transaction->id);
                dd($this->detailTransactions);
            }
        }
        // $this->cart[$productId] = $quantity; // Menambahkan barang dan jumlahnya ke dalam array cart
    }

}
