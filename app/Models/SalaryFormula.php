<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryFormula extends Model
{
    use HasFactory, SoftDeletes, UUID;
    protected $fillable = [
        'per_day',
        'per_hour',
        'per_minute',
        'basic_salary',
        'house_allowance',
        'mess_allowance',
        'travelling_allowance',
        'medical_allowance',
        // 'eid_allowance',
        // 'other_allowance',
        // 'advance_salary',
        // 'electricity',
        // 'arrears',
        // 'income_tax',
        'dated',
        'employee_id'
    ];

    protected $dates = ['dated'];

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * Get the employee that owns the SalaryFormula
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
