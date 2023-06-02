<?php

namespace App\Http\Controllers;

use App\Models\AssignedCompany;
use App\Models\Employee;
use App\Models\EmployeeSalaryStatus;
use App\Models\User;
use App\Traits\EmployeeSalaryUpdatesTrait;
use App\Traits\SalaryGeneratorTrait;
use App\Traits\ZktecoFetchTrait;
use Carbon\Carbon;

class SalaryCronTestController extends Controller
{
    use SalaryGeneratorTrait, EmployeeSalaryUpdatesTrait, ZktecoFetchTrait;
    
    function __invoke()
    {
        $this->fetchAttendance();
        dd('done');
        dd(Employee::restrict()->get());
        // for salary cron job
        // $this->generateMonthlySlipOfAllEmployeesCron();

        // fake populating entry for new employees
        // $this->fakePopulate();

        // business logic
        // $this->updateEmployeeSalaries();

        dd('done');
    }
}
