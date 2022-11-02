<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'max_salary',
        'min_salary',
        'parent_designation_id',   
        'status',
        'owner_id'
    ];

    /**
     * Get the parentDesignation that owns the Designation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_designation(): BelongsTo
    {
        return $this->belongsTo(ParentDesignation::class, 'parent_designation_id', 'id');
    }

    /**
     * Get the owner that owns the Designation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
