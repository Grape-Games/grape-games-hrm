<?php

namespace App\Models;

use App\Traits\UUID;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalarySlip extends Model
{
    use HasFactory,
        SoftDeletes,
        UUID,
        Cachable;

    protected $fillable = [
        'per_day',
        'per_hour',
        'per_minute',
        'basic_salary',
        'house_allowance',
        'mess_allowance',
        'travelling_allowance',
        'medical_allowance',
        'eid_allowance',
        'other_allowance',
        'advance_salary',
        'electricity',
        'arrears',
        'income_tax',
        'employee_id',
        'month_year',
        'total_days',
        'absent_days',
        'present_days',
        'salary_days',
        'half_days',
        'saturdays_included',
        'sundays_included',
        'holidays',
        'calculated_salary',
        'calculated_salary_without_deduction',
        'owner_id'
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * Get the owner that owns the SalarySlip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the employee that owns the SalarySlip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
