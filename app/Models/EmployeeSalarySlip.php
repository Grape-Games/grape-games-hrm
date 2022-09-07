<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSalarySlip extends Model
{
    use HasFactory, UUID;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'per_day',
        'per_hour',
        'per_minute',
        'totalIncrement',
        'basic_salary',
        'total_salary',
        'absents',
        'absent_deduction',
        'half_days',
        'half_day_deduction',
        'late_minutes',
        'late_minutes_deduction',
        'sandwich_rule_deduction',
        'other_deduction',
        'loan',
        'bouns',
        'tax_deduction',
        'deduction_before_compensation',
        'total_deduction',
        'compensation',
        'deduction_after_compensation',
        'approved_salary',
        'dated',
        'employee_id',
        'owner_id',
        'user_id',
    ];

    /**
     * Get the employee that owns the EmpoloyeeSalarySlip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the user that owns the EmpoloyeeSalarySlip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
