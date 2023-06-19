<?php

namespace App\Models;

use App\Traits\UUID;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeBoard extends Model
{
    use HasFactory,
        SoftDeletes,
        UUID,
        Cachable;

    public $incrementing = false;

    protected $keyType = 'uuid';
    protected $fillable = [
        'details',
        'priority',
        'owner_id'
    ];

    /**
     * Get the user that owns the NoticeBoard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
