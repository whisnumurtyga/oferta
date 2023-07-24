<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;

class SupplierShow extends Component
{
    public $search;
    public $supplierId;

    protected $listeners = [
        'deleteConfirmed' => 'deleteSupplier'
    ];


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


    public function deleteConfirmation($supplierId)
    {
        $this->supplierId = $supplierId;
        // dd($this->supplierId);
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteSupplier()
    {
        Supplier::find($this->supplierId)->delete();
        $this->getSuppliers();

        $this->dispatchBrowserEvent('supplier-deleted');
    }

}
