<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereHasScope;
use App\Traits\RestrictTrait;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use Exception;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Support\Str;

class SalaryFormula extends Model
{
    use HasFactory,
        SoftDeletes,
        RestrictTrait,
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
        // 'eid_allowance',
        // 'other_allowance',
        // 'advance_salary',
        // 'electricity',
        // 'arrears',
        // 'income_tax',
        // 'dated',
        'employee_id',
        'increment_due',

    ];

    protected $dates = ['dated'];

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('employee'));

        static::creating(function ($model) {
            try {
                $model->id = (string) Str::uuid(); // generate uuid
                // Change id with your primary key
            } catch (Exception $e) {
                abort(500, $e->getMessage());
            }
        });
    }

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
