<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentType extends Model
{
    use HasFactory,
        SoftDeletes,
        Cachable;

    protected $fillable = [
        'name',
        'owner_id'
    ];

    /**
     * Get the owner that owns the ParentDesignation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo

    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
