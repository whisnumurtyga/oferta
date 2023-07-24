<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;

class SupplierShow extends Component
{
    public $search;
    
    public function render()
    {
        return view('livewire.supplier-show', [
            'suppliers' => $this->getSuppliers()
        ]);
    }

    public function getSuppliers()
    {
        $query = Supplier::orderByDesc('id');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }

        $suppliers = $query->get();

        return $suppliers;
    }

}
