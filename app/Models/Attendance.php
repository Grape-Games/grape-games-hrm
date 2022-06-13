<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereHasScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    // protected $casts = [
    //     'attendance' => 'datetime:Y-m-d'
    // ];

    protected $dates = [
        'attendance'
    ];

    protected $fillable = [
        'employee_id',
        'biometric_device_id',
        'attendance',
    ];

    protected $appends = [
        'time',
        'custom_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('employee'));
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->attendance)->format('H:i:s A');
    }

    public function getCustomDateAttribute()
    {
        return Carbon::parse($this->attendance)->format('l Y-M-d');
    }

    // comment out in production

    public function getAttendanceAttribute($value)
    {
        return Carbon::parse($value)->subHours(5);
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
