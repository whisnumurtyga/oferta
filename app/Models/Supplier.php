<?php

namespace App\Models;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public function goods()
    {
        return $this->hasMany(Good::class);
    }
}
