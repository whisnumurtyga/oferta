<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class HistoryTransactionShow extends Component
{
    public function render()
    {
        return view('livewire.history-transaction-show',[
            'transactions' => $this->getTransactions()
        ]);
    }

    public function getTransactions()
    {
        $query = Transaction::with(['users', 'members', 'status', 'payments'])->orderByDesc('id');
        $transacttions = $query->get();

        return $transacttions;
    }
}
