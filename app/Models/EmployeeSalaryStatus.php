<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereHasScope;
use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSalaryStatus extends Model
{
    use HasFactory,
        Cachable;

    protected $fillable = [
        'time_period',
        'last_increment',
        'last_increment_amount',
        'next_increment',
        'increment_amount',
        'before_increment',
        'status',
        'can_view',
        'employee_id',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('employee'));
    }

    public function getLastIncrementAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getNextIncrementAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Get the employee that owns the EmployeeSalaryStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    /**
     * Get the user that owns the EmployeeSalaryStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
