<?php

namespace App\Http\Livewire;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Livewire\Component;

class HistoryTransactionShow extends Component
{
    public function render()
    {
        return view('livewire.history-transaction-show',[
            'transactions' => $this->getTransactions(),
            'detailTransactions' => $this->getDetailTransactions()
        ]);

    }

    public function getTransactions()
    {
        $query = Transaction::with(['users', 'members', 'status', 'payments'])->orderByDesc('id');
        $transacttions = $query->get();

        return $transacttions;
    }

    public function getDetailTransactions()
    {
        $query = DetailTransaction::with(['transactions', 'goods'])->orderByDesc('id');
        $detailTransactions = $query->get();

        return $detailTransactions;
    }
}
