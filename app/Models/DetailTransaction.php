<?php

namespace App\Models;

use App\Models\Good;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'goods_id',
        'qty',
        'pay',
        'profit',
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function goods()
    {
        return $this->belongsTo(Good::class, 'goods_id', 'id');
    }
}
