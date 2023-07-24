<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Supplier;
use Livewire\Component;
use App\Models\Good;

class GoodsShow extends Component
{
    public $search, $supplier_id_filter, $category_id_filter, $year_filter, $month_filter, $day_filter;
    public $name, $category_id, $supplier_id, $stock, $buy, $sell, $date_in, $date_exp;
    public $new_name, $new_category_id, $new_supplier_id, $new_stock, $new_buy, $new_sell, $new_date_in, $new_date_exp;
    public $goodsId, $goodsUpdate;

    public $editModalClicked = False;
    public $addModalClicked = False;

    protected $listeners = [
        'deleteConfirmed' => 'deleteGoods'
    ];

    protected function rules()
    {
        // Mengabaikan validasi password pada pembaruan
        if ($this->editModalClicked == True) {
            $rules = [
                'new_name' => 'required|string|min:6',
                'new_category_id' => 'required|numeric',
                'new_supplier_id' => 'required|numeric',
                'new_stock' => 'required|numeric',
                'new_buy' => 'required|numeric',
                'new_sell' => 'required|numeric',
                'new_date_in' => 'required',
                'new_date_exp' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required|string|min:6',
                'category_id' => 'required|numeric',
                'supplier_id' => 'required|numeric',
                'stock' => 'required|numeric',
                'buy' => 'required|numeric',
                'sell' => 'required|numeric',
                'date_in' => 'required',
                'date_exp' => 'required',
            ];
        }

        return $rules;
    }


    public function render()
    {
        return view('livewire.goods-show',
        [
            'goods' => $this->getGoods(),
            'suppliers' => Supplier::all(),
            'categories' => Category::all()
        ]);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function getGoods()
    {
        $query = Good::with(['categories', 'suppliers'])->orderByDesc('id');

        if ($this->supplier_id_filter > 0) {
            $query->where('supplier_id', $this->supplier_id_filter);
        }

        if ($this->category_id_filter > 0) {
            $query->where('category_id', $this->category_id_filter);
        }


        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->year_filter) {
            $query->whereYear('date_in', $this->year_filter);
        }

        if ($this->month_filter) {
            $query->whereMonth('date_in', $this->month_filter);
        }

        if ($this->day_filter) {
            $query->whereDay('date_in', $this->day_filter);
        }

        $goods = $query->get();

        return $goods;
    }


    public function deleteConfirmation($goodsId)
    {
        $this->goodsId = $goodsId;
        // dd($this->goodsId);
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteGoods()
    {
        Good::find($this->goodsId)->delete();
        $this->getGoods();

        $this->dispatchBrowserEvent('goods-deleted');
    }

    public function addGoods()
    {
        $this->addModalClicked = True;
        $this->editModalClicked = False;
        // dd("hola");
        $validatedData = $this->validate();
        Good::create($validatedData);
        $this->getGoods();
        $this->resetInput();

        $this->dispatchBrowserEvent('create-goods-alert');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function addModalClosed()
    {
        $this->addModalClicked = False;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = null;
        $this->category_id = null;
        $this->supplier_id = null;
        $this->stock = null;
        $this->buy = null;
        $this->sell = null;
        $this->date_in = null;
        $this->date_exp = null;
    }

    public function editGoods(int $goodsId)
    {
        $this->addModalClicked = False;
        $this->editModalClicked = True;

        // dd($goodsId);
        $this->goodsUpdate = Good::find($goodsId);

        $this->goodsId = $goodsId;
        $this->new_name = $this->goodsUpdate->name;
        $this->new_category_id = $this->goodsUpdate->category_id;
        $this->new_supplier_id = $this->goodsUpdate->supplier_id;
        $this->new_stock = $this->goodsUpdate->stock;
        $this->new_buy = $this->goodsUpdate->buy;
        $this->new_sell = $this->goodsUpdate->sell;
        $this->new_date_in = $this->goodsUpdate->date_in;
        $this->new_date_exp = $this->goodsUpdate->date_exp;
    }

    public function updateGoods()
    {
        $validatedData = $this->validate();

        Good::where('id', $this->goodsId)->update([
            'name' => $validatedData['new_name'],
            'category_id' => $validatedData['new_category_id'],
            'supplier_id' => $validatedData['new_supplier_id'],
            'stock' => $validatedData['new_stock'],
            'buy' => $validatedData['new_buy'],
            'sell' => $validatedData['new_sell'],
            'date_in' => $validatedData['new_date_in'],
            'date_exp' => $validatedData['new_date_exp'],
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('goods-updated');
        $this->dispatchBrowserEvent('close-modal');
    }



    public function editModalClosed()
    {
        $this->editModalClicked = False;
        $this->resetInput();
    }
}
