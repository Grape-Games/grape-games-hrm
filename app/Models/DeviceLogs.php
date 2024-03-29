<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceLogs extends Model
{
    use HasFactory,
        SoftDeletes,
        Cachable;

    protected $fillable = [
        'details',
        'type',
        'action',
        'device_id',
    ];

    /**
     * Get the biometric_device that owns the DeviceUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biometric_device(): BelongsTo
    {
        return $this->belongsTo(BiometricDevice::class, 'device_id', 'id');
    }
}
