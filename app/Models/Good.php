<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $table = 'goods';
    protected $fillable = ['name', 'category_id', 'supplier_id', 'stock', 'buy', 'sell', 'date_in', 'date_exp'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

}

