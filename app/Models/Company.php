<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, UUID;

    public $incrementing = false;
    protected $keyType = 'uuid';

    // protected $casts = [
    //     'time_in' => 'datetime:g:i a',
    //     'time_out' => 'datetime:g:i a'
    // ];

    protected $fillable = [
        'name',
        'branch_name',
        'time_in',
        'time_out',
        'status',
        'grace_minutes',
        'late_minutes_deduction',
        'owner_id'
    ];


    /**
     * Get all of the departments for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Get the owner that owns the Department
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
