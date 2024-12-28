<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'gender',
        'father_name',
        'mother_name',
        'birth_date',
        'nationality',
        'phone',
        'nid',
        'email',
        'role_id',
        'designation',
        'password',
        'join_date',
        'regain_date',
        'active_status',
        'status',
        'image',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function employeeAddress(): HasOne
    {
        return $this->hasOne(EmployeeAddress::class, 'employee_id');
    }
}
