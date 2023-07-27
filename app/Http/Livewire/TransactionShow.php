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
    public $flagRules = False;


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
        $this->transaction = $transaction;
        return $transaction;
    }

    public function getDetailTransaction($transactionId)
    {
        $detailTransaction = DetailTransaction::where('transaction_id', $transactionId)->get();
        $this->detailTransactions = $detailTransaction;
        return $detailTransaction;
    }

    public function getGood($goodId)
    {
        $good = Good::where('id', $goodId)->first();
        return $good;
    }

    public function checkDetailTransaction($goodId, $transactionId)
    {
        $dt = DetailTransaction::where('transaction_id', $transactionId)
            ->where('goods_id', $goodId)->first();
        return $dt;
    }
    public function addDetailTransaction($goodId, $qty)
    {
        $good =  $this->getGood($goodId);
        if($qty != 0 && $qty != "") {
            // TODO: Untuk Handle kalo udah ada transaksi yang pending
            $transaction = $this->getTransaction();
            if($transaction != null) {
                // $this->getDetailTransaction($this->transaction->id);
                $oldDt = $this->checkDetailTransaction($goodId, $transaction->id);


                if($oldDt != null) {
                    $this->updateDetailTransaction($oldDt->id, $good, $qty);
                } else {
                    DetailTransaction::create([
                        'transaction_id' => $this->transaction->id,
                        'goods_id' => $goodId,
                        'qty' => $qty,
                        'pay' => $good->sell * $qty,
                        'profit' => ($good->sell * $qty) - ($good->buy * $qty)
                    ]);

                    Good::where('id', $goodId)->update([
                        'stock' => $good->stock - $qty,
                    ]);
                }

            }
        }
        // $this->cart[$productId] = $quantity; // Menambahkan barang dan jumlahnya ke dalam array cart
    }

    public function updateDetailTransaction($detailTransactionId, $good, $qty)
    {
        $dt = DetailTransaction::where('id', $detailTransactionId)->first();
        $old_pay = $dt->pay;
        $old_profit = $dt->profit;
        $old_qty = $dt->qty;
        $old_stock = $good->stock;

        DetailTransaction::where('id', $detailTransactionId)->update([
            'qty' => $old_qty + $qty,
            'pay' => $old_pay + ($good->sell * $qty),
            'profit' => $old_profit + (($good->sell * $qty) - ($good->buy * $qty))
        ]);

        Good::where('id', $good->id)->update([
            'stock' => $old_stock - $qty,
        ]);

    }
    public function deleteDetailTransaction($detailTransactionId)
    {
        // dd($detailTransactionId);
        DetailTransaction::find($detailTransactionId)->delete();
        $this->getDetailTransaction($this->transaction->id);
    }

}
