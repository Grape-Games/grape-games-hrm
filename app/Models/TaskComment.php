<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'task_id',
        'created_at',
        'user_id',
    ];

    public function task() 
    {
        return $this->hasOne(task::class, 'id', 'task_id');
    }
    public function user() 
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
