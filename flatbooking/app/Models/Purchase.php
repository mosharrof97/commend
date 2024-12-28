<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'vendor_id',
        'memo_no',
        'invoice_no',
        'date',
        'name',
        'price',
        'quantity',
        'unit',
        'total_price',
        'total',
        'service_charge',
        'shipping_charge',
        'total_amount',
        'discount',
        'payable_amount',
        'paid',
        'due',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'name' => 'array',
        'quantity' => 'array',
        'unit' => 'array',
        'price' => 'array',
        'total_price' => 'array',
        'date' => 'datetime',
    ];

    public function project() {
       return $this->BelongsTo(Project::class);
    }

    public function user() {
        return $this->BelongsTo(User::class, 'created_by');
     }

    public function vendor() {
        return $this->BelongsTo(Vendor::class);
    }

    public function re_purchase() :HasMany
    {
        return $this->hasMany(ReturnPurchase::class, 'purchase_id');
    }

    public function pur_due_pay() :HasMany
    {
        return $this->hasMany(PurchaseDuePay::class, );
    }

}
