<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'active_status',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function purchase() {
        return $this->HasMany(Purchase::class,'vendor_id');
    }

    public function re_purchase() {
        return $this->HasMany(ReturnPurchase::class,'vendor_id');
    }
}
