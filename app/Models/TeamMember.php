<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;  
    protected $fillable = [
        'assigned_by',
        'assigned_to',
        'employee_id',
    ];

    public function employee() 
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function assigned_by() 
    {
        return $this->hasOne(User::class, 'id', 'assigned_by');
    }
}   
