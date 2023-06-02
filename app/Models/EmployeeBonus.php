<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\GlobalRestrictionsWhereHasScope;

class EmployeeBonus extends Model
{
    use HasFactory;
     protected $fillable = [
    'user_id',
    'employee_id',
    'assigned_by',
    'bonus_name',
    'month',
    'amount',
    'description',
    'created_at',
    ];

     protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereHasScope('employee'));
    }  

       public function employee() 
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function user(){
        return $this->hasOne (User::class, 'id', 'assigned_by');
    }

}
