<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'employee_id',
    'assigned_by',
    'name',
    'amount',
    'number_installment',
    'description',
    'status',
    'created_at',
    ];

    public function employee() 
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function user(){
        return $this->hasOne (User::class, 'id', 'assigned_by');
    }
    public function loan_installment(){
        return $this->hasMany(LoanInstallment::class);
    }
}
  