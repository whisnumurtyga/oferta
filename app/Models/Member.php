<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'major',
        'faculty',
        'year',
    ];

    public function Transaction()
    {
        return $this->hasMany(Transaction::class,);
    }


}
