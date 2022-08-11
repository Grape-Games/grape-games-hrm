<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialRequestStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'status',
        'designation',
        'updated_by',
        'material_request_id',
    ];


    /**
     * Get the user that owns the MaterialRequestStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Get the materialRequest that owns the MaterialRequestStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materialRequest(): BelongsTo
    {
        return $this->belongsTo(MaterialRequest::class);
    }
}
