<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAdditionalInformation extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = [
        'dob',
        'demise_date',
        'join_date',
        'leave_date'
    ];

    protected $fillable = [
        'address',
        'blood_group',
        'cast_of_staff',
        'certificate_name',
        'demise_date',
        'dob',
        'join_date',
        'leave_date',
        'referred_by',
        'job_description',
        'employee_id'
    ];

    protected $hidden = [
        'employee_id',
    ];


    /**
     * Get the employee that owns the EmployeeAdditionalInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
