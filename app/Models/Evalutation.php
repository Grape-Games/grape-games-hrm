<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evalutation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'employee_id',
        'month',
        'planning_coordination',
        'quality_work',
        'communication_skill',
        'confidence_level',
        'time_managment',
        'over_all_performance',
        'area_of_improvements',
        'additional_comments'
    ];

    public function employee() 
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function user(){
        return $this->hasOne (User::class, 'id', 'user_id');
    }
}
