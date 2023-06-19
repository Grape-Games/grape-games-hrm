<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereHasScope;
use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LateMinutes extends Model
{
    use HasFactory,
        SoftDeletes,
        Cachable;

    protected $fillable = [
        'month',
        'minutes',
        'date',
        'type',
        'employee_id',
        'owner_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('employee'));
    }

    public function scopeEmployeeHalfDays($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId)->where('type', 'half_day');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Get the owner that owns the LateMinutes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the employee that owns the LateMinutes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
