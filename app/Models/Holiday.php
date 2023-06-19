<?php

namespace App\Models;

use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use HasFactory,
        SoftDeletes,
        Cachable;

    protected $casts = [
        'date' => 'datetime:l F j, Y'
    ];
    protected $appends = [
        'custom_date',
        'custom_date_second'
    ];

    protected $fillable = [
        'date',
        'details',
        'owner_id',
        'owner_id',
        'sandwich_id',
    ];

    public function getCustomDateAttribute()
    {
        return Carbon::parse($this->date)->format('l Y-M-d');
    }

    public function getCustomDateSecondAttribute()
    {
        return Carbon::parse($this->date)->format('Y-m-d');
    }

    /**
     * Get the user that owns the Holiday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function sandwich()
    {
        return $this->belongsTo(SandWichRule::class, 'sandwich_id', 'id');
    }
}
