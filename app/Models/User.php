<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'role_id',
        'designation',
        'active_status',
        'status',
        'password',
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

    public function role(){
        return $this->BelongsTo(Role::class);
    }

    public function expense() {
        return $this->HasMany(Expense::class,'created_by');
    }

    public function purchase() {
        return $this->HasMany(Purchase::class);
    }

    public function pur_due_pay() {
        return $this->HasMany(PurchaseDuePay::class,'id');
    }

    public function re_purchase() {
        return $this->HasMany(ReturnPurchase::class);
    }

    public function payment() {
        return $this->HasMany(Payment::class,'received_by');
    }

    public function refund() {
        return $this->HasMany(Refund::class,'received_by');
    }

    public function paymentReturn() {
        return $this->HasMany(PaymentReturn::class,'id');
    }

    public function project() {
        return $this->HasMany(Project::class,'created_by');
    }

    public function investInstallment() {
        return $this->HasMany(InvestInstallment::class,'received_by');
    }

    public function investment() {
        return $this->HasMany(Investment::class);
    }


    public function re_soldFlats()
    {
        return $this->hasMany(FlatReturnInfo::class, 'sold_by');
    }

    public function re_bookedFlats()
    {
        return $this->hasMany(FlatReturnInfo::class, 'booking_by');
    }

    public function returnedFlats()
    {
        return $this->hasMany(FlatReturnInfo::class, 'return_by');
    }
}
