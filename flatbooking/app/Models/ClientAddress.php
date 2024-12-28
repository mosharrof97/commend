<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ClientAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'pre_address',
        'pre_city',
        'pre_district',
        'pre_zipCode',

        'per_address',
        'per_city',
        'per_district',
        'per_zipCode',
    ];

    // public function district(): BelongsTo
    // {
    //     return $this->belongsTo(District::class );
    // }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Client::class,);
    }
}
