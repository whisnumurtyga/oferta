<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\DetailTransaction;
use App\Models\Good;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionShow extends Component
{
    public $search, $supplier_id_filter, $category_id_filter, $price_filter;
    public $qty, $detail_member, $detail_payment;
    public $transaction, $detailTransaction;
    public $flagRules = False;


    protected $listeners = [
        'addDetailTransaction' => 'addDetailTransaction'
    ];

    public function render()
    {
        $transaction = $this->getTransaction();
        if($transaction == null) {
            $detailTransaction = null;
        }else {
            $detailTransaction = $this->getDetailTransaction($this->getTransaction()->id);
        }

        return view('livewire.transaction-show', [
            'goods' => $this->getGoods(),
            'members' => Member::all(),
            'suppliers' => Supplier::all(),
            'payments' => Payment::all(),
            'categories' => Category::all(),
            'transactions' => $transaction,
            'detailTransaction' => $detailTransaction,
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
        $this->detailTransaction = $detailTransaction;
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
        $transaction = Transaction::where("user_id", Auth::user()->id)
            ->where('status_id', 1)
            ->first();
        $good =  $this->getGood($goodId);
        if ($qty != 0 && $qty != "") {
            if($transaction != null) {
                // dd("ada transaksi sebelumnya");
                $oldDt = $this->checkDetailTransaction($goodId, $transaction->id);
                if($oldDt != null) {
                    // dd("heheh");
                    // dd("heheh");
                    $this->updateDetailTransaction($oldDt->id, $good, $qty);
                } else {
                    DetailTransaction::create([
                        'transaction_id' => $transaction->id,
                        'goods_id' => $goodId,
                        'qty' => $qty,
                        'pay' => $good->sell * $qty,
                        'profit' => ($good->sell * $qty) - ($good->buy * $qty)
                    ]);

                    Good::where('id', $goodId)->update([
                        'stock' => $good->stock - $qty,
                    ]);
                }
            } else {
                // dd(  "tidak ada transaksi sebelumnya - buat baru");
                $newTransaction = Transaction::create([
                    'user_id' => Auth::user()->id,
                ]);

                DetailTransaction::create([
                    'transaction_id' => $newTransaction->id,
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

    public function updateDetailTransaction($detailTransactionId, $good, $qty)
    {
        $dt = DetailTransaction::where('id', $detailTransactionId)->first();

        DetailTransaction::where('id', $detailTransactionId)->update([
            'qty' => $dt->qty + $qty,
            'pay' => $dt->pay + ($good->sell * $qty),
            'profit' => $dt->profit+ (($good->sell * $qty) - ($good->buy * $qty))
        ]);

        Good::where('id', $good->id)->update([
            'stock' => $good->stock - $qty,
        ]);

    }
    public function deleteDetailTransaction($detailTransactionId)
    {
        // dd($detailTransactionId);
        $dt = DetailTransaction::where('id', $detailTransactionId)->first();
        $good = Good::where('id', $dt->goods_id)->first();

        Good::where('id', $dt->goods_id)->update([
            'stock' => $good->stock + $dt->qty,
        ]);
        DetailTransaction::find($detailTransactionId)->delete();
        $this->getDetailTransaction($this->transaction->id);
    }

    public function generateOrderId()
    {
        $role = Auth::user()->role->name;
        $role_kode = '';
        if($role == 'Owner') {
            $role_kode = 'OWN';
        }else if($role == 'Admin') {
            $role_kode = 'ADM';
        }else {
            $role_kode = 'KSR';
        }

        $result = $role_kode . "-" . rand(1, 50) . "-" . rand(11, 100);
        return $result;
    }

    public function addTransaction()
    {
        if($this->detail_member == null || $this->detail_member == -1 || $this->detail_payment == null) {
            $this->dispatchBrowserEvent('add-transaction-alert');
            return;
        }

        $transaction = Transaction::where('user_id', Auth::user()->id)
            -> where('status_id', 1)->first();

        $dts = DetailTransaction::where('transaction_id', $transaction->id)->get();

        $total_pay = 0;
        $total_profit = 0;

        foreach($dts as $dt) {
            $total_pay += $dt->pay;
            $total_profit += $dt->profit;
        }

        $transaction->update([
            'order_id' => $this->generateOrderId(),
            'date' => Carbon::now(),
            'member_id' => $this->detail_member == -1 ? null : $this->detail_member,
            'total_pay' => $total_pay,
            'total_profit' => $total_profit,
            'status_id' => 2,
            'payment_id' => $this->detail_payment,
        ]);

        $this->detailTransaction = null;

        $this->dispatchBrowserEvent('add-transaction-success');
        // $this->render();
        return;
    }

}
