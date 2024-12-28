<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnPurchaseBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance',
    ];
}
