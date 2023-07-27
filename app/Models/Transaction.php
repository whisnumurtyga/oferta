<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Payment;
use App\Models\Status;
use App\Models\User;
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


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }


    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }


    public function payments()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }


    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class,);
    }

}
