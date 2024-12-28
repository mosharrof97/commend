<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FlatSaleInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'flat_id',
        'price',
        'status',
        'sold_by',
        'created_by',
    ];

    public function flat(): BelongsTo
    {
        return $this->belongsTo(Flat::class,'flat_id');
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class, 'flat_sale_id' );
    }

    public function refund(): HasMany
    {
        return $this->hasMany(Refund::class, 'flat_sale_id' );
    }
}
