<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Good;

class GoodsShow extends Component
{
    public function render()
    {
        return view('livewire.goods-show',
        [
            'goods' => $this->getGoods(),
        ]);
    }

    public function getGoods()
    {
        $query = Good::with(['categories', 'suppliers'])->orderByDesc('id');

        // if ($this->search) {
        //     $query->where(function ($q) {
        //         $q->where('name', 'like', '%' . $this->search . '%')
        //             ->orWhere('phone', 'like', '%' . $this->search . '%');
        //     });
        // }

        $goods = $query->get();

        return $goods;
    }
}
