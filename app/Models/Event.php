<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,
        SoftDeletes,
        Cachable;

    protected $fillable = [
        'name',
        'category',
        'start_time',
        'end_time',
        'owner_id'
    ];

    protected $casts = [
        'start_time' => 'datetime:Y-M-d H:i',
        'end_time' => 'datetime:Y-M-d H:i',
    ];

    /**
     * Get the user that owns the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
