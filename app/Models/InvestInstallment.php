<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestInstallment extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'investment_id',
        'payment_type',
        'installment_amount',
        'bank_name',
        'branch',
        'account_number',
        'check_number',

        'received_by'
    ];

    public function investment(): BelongsTo
    {
        return $this->BelongsTo(Investment::class,'investment_id');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'id');
    }

    public function project(): BelongsTo
    {
        return $this->BelongsTo(Project::class, 'project_id');
    }


}
