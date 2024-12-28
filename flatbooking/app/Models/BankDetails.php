<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'instalment_id',
        'name',
        'account_number',
        'description',
        'status',

        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
