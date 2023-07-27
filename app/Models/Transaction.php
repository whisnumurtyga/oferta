<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'member_id',
        'total_pay',
        'total_profit',
        'status_id',
        'payment_id',
    ];

}
