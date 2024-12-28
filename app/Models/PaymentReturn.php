<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'flat_return_id',
        'payment_type',
        'amount',
        'bank_name',
        'branch',
        'account_number',
        'check_number',
        'status',

        'received_by',
    ];

    public function flatReturn(){
        return $this->BelongsTo(FlatReturnInfo::class,'flat_return_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
