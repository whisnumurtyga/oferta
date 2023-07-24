<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;

class SupplierShow extends Component
{
    public $search;
    public $name, $phone, $address;
    public $new_name, $new_phone, $new_address;
    public $supplierId, $supplierUpdate;
    public $editModalClicked = False;
    public $addModalClicked = False;

    protected $listeners = [
        'deleteConfirmed' => 'deleteSupplier'
    ];


    public function render()
    {
        return view('livewire.supplier-show', [
            'suppliers' => $this->getSuppliers()
        ]);
    }

    protected function rules()
    {
        if ($this->editModalClicked == True) {
            $rules = [
                'new_name' => 'required|string',
                'new_phone' => 'required|numeric|digits:12',
                'new_address' => 'required|string',
            ];
        } else {
            $rules = [
                'name' => 'required|string',
                'phone' => 'required|numeric|digits:12',
                'address' => 'required|string',
            ];
        }

        return $rules;
    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
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

    public function addSupplier()
    {
        $this->addModalClicked = True;
        $this->editModalClicked = False;
        $validatedData = $this->validate();
        Supplier::create($validatedData);
        $this->getSuppliers();
        $this->resetInput();

        $this->dispatchBrowserEvent('create-supplier-alert');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function addModalClosed()
    {
        $this->addModalClicked = False;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = "";
        $this->phone = "";
        $this->address = "";
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

    public function editSupplier($supplierId)
    {
        $this->addModalClicked = False;
        $this->editModalClicked = True;

        $this->supplierUpdate = Supplier::find($supplierId);

        $this->supplierId = $supplierId;
        $this->new_name = $this->supplierUpdate->name;
        $this->new_phone = $this->supplierUpdate->phone;
        $this->new_address = $this->supplierUpdate->address;
    }

    public function updateSupplier()
    {
        $validatedData = $this->validate();

        Supplier::where('id', $this->supplierId)->update([
            'name' => $validatedData['new_name'],
            'phone' => $validatedData['new_phone'],
            'address' => $validatedData['new_address'],
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('supplier-updated');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editModalClosed()
    {
        $this->editModalClicked = False;
        $this->resetInput();
    }


}
