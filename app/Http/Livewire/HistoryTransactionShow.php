<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\DetailTransaction;
use App\Models\Member;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class HistoryTransactionShow extends Component
{
    public $search, $member_id_filter, $user_id_filter, $year_filter, $month_filter, $day_filter;
    public $hist_transactions, $hist_detailTransactions;
    public $detailModalClicked = False;

    public function render()
    {
        return view('livewire.history-transaction-show',[
            'transactions' => $this->getTransactions(),
            'detailTransactions' => $this->getDetailTransactions(),
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
            'members' => Member::all(),
            'users' => User::all(),
        ]);

    }

    public function getTransactions()
    {
        $query = Transaction::with(['users', 'members', 'status', 'payments'])->orderByDesc('id');

        if ($this->user_id_filter > 0) {
            $query->where('user_id', $this->user_id_filter);
        }

        if ($this->member_id_filter > 0) {
            $query->where('member_id', $this->member_id_filter);
        }


        if ($this->search) {
            $query->where(function ($q) {
                $q->where('order_id', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->year_filter) {
            $query->whereYear('date', $this->year_filter);
        }

        if ($this->month_filter) {
            $query->whereMonth('date', $this->month_filter);
        }

        if ($this->day_filter) {
            $query->whereDay('date', $this->day_filter);
        }

        $transacttions = $query->get();
        return $transacttions;
    }

    public function getDetailTransactions()
    {
        $query = DetailTransaction::with(['transactions', 'goods'])->orderByDesc('id');
        $detailTransactions = $query->get();

        return $detailTransactions;
    }

    public function getTransaction($transactionId)
    {
        $transaction = Transaction::where('id', $transactionId)->with(['users', 'members', 'status', 'payments'])->first();
        $this->hist_transactions =  $transaction;
    }

    public function getDetailTransaction($transactionId){
        $detailTransaction = DetailTransaction::where('transaction_id', $transactionId)->with(['transactions', 'goods'])->get();
        $this->hist_detailTransactions = $detailTransaction;
    }

    public function clickDetail($transactionId)
    {
        // dd($transactionId);
        $this->detailModalClicked = True;
        if($this->detailModalClicked == True) {
            $this->getTransaction($transactionId);
            $this->getDetailTransaction($transactionId);
            // $this->detailModalClicked = False;
        }

        // dd($this->hist_transactions, $this->hist_detailTransactions);
    }
}
