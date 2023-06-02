<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SandWichRule extends Model
{
    use HasFactory;
     
     protected $fillable = ['name','date','status','assigned_by'];

      public function user(){
        return $this->hasOne (User::class, 'id', 'assigned_by');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function holiday(): HasMany
    {
        return $this->hasMany(Holiday::class);
    }
}
