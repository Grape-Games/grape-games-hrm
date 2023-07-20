<?php

namespace App\Observers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmployeeObserver
{
    public function deleting(Employee $employee)
    {
        Schema::disableForeignKeyConstraints();
        $employee->salaryFormula()->delete();
        $employee->bank()->delete();
        $employee->additional()->delete();
        $employee->emergency()->delete();
        $employee->user()->delete();
        Schema::enableForeignKeyConstraints();
    }
}
