<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Caching;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeBankDetails extends Model
{
    use HasFactory,
        SoftDeletes,
        Caching;

    protected $fillable = [
        'account_title',
        'account_number',
        'bank_name',
        'branch_name',
        'employee_id'
    ];

    /**
     * Get the employee that owns the EmployeeBankDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
