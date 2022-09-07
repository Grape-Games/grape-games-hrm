<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Increment extends Model
{
    use HasFactory;
    protected $fillable = [
    
    'employee_id',
    'assigned_by',
    'month',
    'amount',
    'percentage',
    'last_increment',
    'purpose',
    'type',
    ];
       public function employee() 
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function user(){
        return $this->hasOne (User::class, 'id', 'assigned_by');
    }
}
