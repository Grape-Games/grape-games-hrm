<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_by',
        'assigned_to',
        'project_id',
        'start_date',
        'end_date',
        'priority',
        'details',
        'status',
    ];

    public function user(){
        return $this->hasOne (User::class, 'id', 'assigned_by');
    }
    public function employee() 
    {
        return $this->hasOne(Employee::class, 'id', 'assigned_to');
    }
    public function project() 
    {
        return $this->hasOne(project::class, 'id', 'project_id');
    }

    public function task_comment()
    {
        return $this->belongsTo(TaskComment::class);
    }
}
