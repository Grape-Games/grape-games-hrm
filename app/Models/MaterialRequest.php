<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MaterialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'qty',
        'description',
        'employee_id',
    ];

    public function scopeWithWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    public function isApprovedByHr()
    {
        return MaterialRequestStatus::whereBelongsTo($this)->whereStatus(true)->count() > 0 ? true : false;
    }

    public function isApprovedByCeo()
    {
        return MaterialRequestStatus::whereBelongsTo($this)->whereStatus(true)->count() > 1 ? true : false;
    }

    public function isApprovedByAdmin()
    {
        return MaterialRequestStatus::whereBelongsTo($this)->whereStatus(true)->count() > 2 ? true : false;
    }

    public function isApprovedByFinance()
    {
        return MaterialRequestStatus::whereBelongsTo($this)->whereStatus(true)->count() > 3 ? true : false;
    }

    /**
     * Get all of the statuses for the MaterialRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userStatuses(): HasMany
    {
        return $this->hasMany(MaterialRequestStatus::class, 'material_request_id', 'id')->whereBelongsTo(auth()->user());
    }

    public function latest(): HasOne
    {
        return $this->hasOne(MaterialRequestStatus::class, 'material_request_id', 'id')->latest();
    }

    /**
     * Get all of the statuses for the MaterialRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(MaterialRequestStatus::class, 'material_request_id', 'id');
    }

    /**
     * Get the employee that owns the MaterialRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
