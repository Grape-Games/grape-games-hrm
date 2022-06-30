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
        "per_day",
        "basic_salary",
        "salaried_days",
        "leaves",
        "days_deduction",
        "late_minutes",
        "late_minutes_deduction",
        "net_salary",
        "deduction_compensated",
        "advance",
        "loan",
        "electricity",
        "income_tax",
        "over_time_hours",
        "over_time_pay",
        "over_time_pay_status",
        "dated",
        "half_days",
        "employee_id",
        "user_id"
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
