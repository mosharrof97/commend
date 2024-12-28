<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FlatReturnInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'flat_id',
        'project_id',
        'client_id',
        'buying_price',
        'payable_amount',
        
        'status',
        'sold_by',
        'booking_by',
        'return_by',
    ];

    public function paymentReturn():HasMany
    {
        return $this->hasMany(PaymentReturn::class,'flat_return_id');
    }

    public function project(){
        return $this->BelongsTo(Project::class,'project_id');
    }

    public function flat(){
        return $this->BelongsTo(Flat::class,'flat_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function soldBy()
    {
        return $this->belongsTo(User::class, 'sold_by');
    }

    public function bookedBy()
    {
        return $this->belongsTo(User::class, 'booking_by');
    }

    public function returnedBy()
    {
        return $this->belongsTo(User::class, 'return_by');
    }
}
