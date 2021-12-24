<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'employee_id',
        'biometric_device_id',
        'state',
        'attendance',
        'type'
    ];

    public function setStateAttribute($value)
    {
        $value == 1
            ? $this->attributes['state'] = 'Fingerprint'
            : $this->attributes['state'] = 'Undefined';
    }

    public function setTypeAttribute($value)
    {
        $value == 0
            ? $this->attributes['type'] = 'Check-in'
            : $this->attributes['type'] = 'Check-out';
    }

    /**
     * Get the employee that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Get the biometric_device that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biometric_device(): BelongsTo
    {
        return $this->belongsTo(BiometricDevice::class, 'biometric_device_id', 'id');
    }
}
