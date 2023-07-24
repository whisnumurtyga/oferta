<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Supplier;
use Livewire\Component;
use App\Models\Good;

class GoodsShow extends Component
{
    public $search, $supplier_id_filter, $category_id_filter;

    public function render()
    {
        return view('livewire.goods-show',
        [
            'goods' => $this->getGoods(),
            'suppliers' => Supplier::all(),
            'categories' => Category::all()
        ]);
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

        $goods = $query->get();

        return $goods;
    }
}
