<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flat extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'project_id',
        'client_id',
        'name',
        'floor',
        'flat_area',
        'price',
        'room',
        'dining_space',
        'bath_room',
        'description',
        'parking',
        'outdoor',
        'images',
        'active_status',
        'sale_status',
        'status',

        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected $casts = [
        'images' => 'array',
    ];
    public function project(): BelongsTo
    {
        return $this->BelongsTo(Project::class, 'project_id');
    }

    public function client(): BelongsTo
    {
        return $this->BelongsTo(Client::class, 'client_id');
    }

    public function flatSaleInfo():HasOne
    {
        return $this->hasOne(FlatSaleInfo::class,'flat_id');
    } 

    public function payment():HasMany
    {
        return $this->hasMany(Payment::class, 'flat_id');
    }

    public function refund():HasMany
    {
        return $this->hasMany(Refund::class, 'flat_id');
    }

    public function flatReInfo():HasMany
    {
        return $this->hasMany(FlatReturnInfo::class);
    }

    


    // public function count(){
    //     return Flat::where('sale_status', $this->sale_status)->count();
    // }
}
