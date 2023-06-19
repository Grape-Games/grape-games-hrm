<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereHasScope;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceRequest extends Model
{
    use HasFactory,
        SoftDeletes,
        Cachable;

    protected $dates = [
        'date'
    ];
    protected $fillable = [
        'date',
        'type',
        'query',
        'remarks',
        'status',
        'submitted_by',
        'reviewed_by'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('user.employee'));
    }

    /**
     * Get the user that owns the AttendanceRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }

    /**
     * Get the user that owns the AttendanceRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by', 'id');
    }
}
