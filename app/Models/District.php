<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bn_name',
    ];


    public function investor(): HasMany
    {
        return $this->hasMany(Investor::class, 'pre_district');
    }

    public function project(): HasMany
    {
        return $this->hasMany(Project::class, 'district_id');
    }
}
