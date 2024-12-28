<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'father_name',
        'mother_name',
        'phone',
        'email',
        'nid',
        'tin',
        'password',
        'role_id',
        'active_status',
        'status',
        'image',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function investment(){
        return $this->HasMany(Investment::class);
    }

    public function flat():HasMany
    {
        return $this->hasMany(Flat::class, 'client_id','id');
    }

    public function clientAddress(): HasOne
    {
        return $this->hasOne(ClientAddress::class, 'client_id');
    }

    public function flatReInfo():HasMany
    {
        return $this->hasMany(FlatReturnInfo::class);
    }
}
