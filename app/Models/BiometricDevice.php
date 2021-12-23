<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiometricDevice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'internal_id',
        'ip_address',
        'description',
        'owner_id'
    ];

    /**
     * Get the user that owns the BiometricDevice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
