<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereHasScope;
use App\Traits\RestrictTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class EmployeeLeaves extends Model
{
    use HasFactory, SoftDeletes, RestrictTrait;
    protected $fillable = [
        'description',
        'number_of_leaves',
        'leave_type_id',
        'remarks',
        'year',
        'from_date',
        'to_date',
        'status',
        'owner_id',
        'approved_by'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('owner.employee'));
    }

    public function getFromDateAttribute($value)
    {
        return Carbon::parse($value)->format('l F j, Y, g:i a');
    }

    public function getToDateAttribute($value)
    {
        return Carbon::parse($value)->format('l F j, Y, g:i a');
    }

    public function scopeApproved($query, $userId, $month)
    {
        return $query->where(
            [
                'status' => 'approved',
                'owner_id' => $userId,
            ]
        )->whereMonth('created_at', $month)->sum('number_of_leaves');
    }

    // public function scopeRestrictWith($query, $relation)
    // {
    //     if (Gate::allows('is-admin')) {
    //         return $query->whereHas($relation, function ($query) {
    //             $query->whereIn('company_id', $this->getCurrentUserCompaniesArray());
    //         });
    //     }
    // }


    /**
     * Get the owner that owns the EmployeeLeaves
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the approvedBy that owns the EmployeeLeaves
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    /**
     * Get the type that owns the EmployeeLeaves
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id', 'id');
    }
}
