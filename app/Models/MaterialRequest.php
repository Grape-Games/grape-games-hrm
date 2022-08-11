<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get all of the statuses for the MaterialRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(MaterialRequestStatus::class, 'material_request_id', 'id');
    }
}
