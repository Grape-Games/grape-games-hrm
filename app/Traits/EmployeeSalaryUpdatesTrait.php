<?php

namespace App\Traits;

use App\Models\Employee;
use App\Models\EmployeeSalaryStatus;
use App\Models\User;
use App\Services\MailService;
use Carbon\Carbon;

trait EmployeeSalaryUpdatesTrait
{
    use SalaryGeneratorTrait;

    public function fakePopulate()
    {
        $employees = $this->getAllEmployees();
        foreach ($employees as $key => $value) {
            if (!EmployeeSalaryStatus::where('employee_id', $value->id)->exists()) {
                EmployeeSalaryStatus::firstOrCreate([
                    'employee_id' => $value->id,
                    'last_increment' => $value->last_increment,
                    'next_increment' => $value->next_increment
                ], [
                    'time_period' => 6,
                    'last_increment' => Carbon::now()->startOfMonth(),
                    'last_increment_amount' => isset($value->salaryFormula) ? 1000 : 0,
                    'next_increment' => Carbon::now()->startOfMonth()->addMonths(6),
                    'increment_amount' => isset($value->salaryFormula) ? 1000 : 0,
                    'before_increment' => $value->salaryFormula->basic_salary ?? 0,
                    'employee_id' => $value->id,
                    'user_id' => User::where('role', 'admin')->first()->id
                ]);
            }
        }
    }
    public function updateEmployeeSalaries()
    {
        $increments = EmployeeSalaryStatus::latest()->distinct('employee_id')->get();
        foreach ($increments as $key => $increment) {
            if ($increment->next_increment->isPast()) {
                if ($increment->status != "applied") {
                    $increment->employee->salaryFormula->increment('basic_salary', $increment->increment_amount);
                    $increment->update(['status' => 'applied']);
                    EmployeeSalaryStatus::firstOrCreate([
                        'employee_id' => $increment->employee_id,
                        'last_increment' => $increment->next_increment,
                        'next_increment' => $increment->next_increment->addMonths($increment->time_period)
                    ], [
                        'time_period' => $increment->time_period,
                        'last_increment' => $increment->next_increment,
                        'last_increment_amount' => isset($increment->employee->salaryFormula) ? $increment->increment_amount : 0,
                        'next_increment' => $increment->next_increment->addMonths($increment->time_period),
                        'increment_amount' => isset($increment->employee->salaryFormula) ? $increment->increment_amount : 0,
                        'before_increment' => $increment->employee->salaryFormula->basic_salary ?? 0,
                        'employee_id' => $increment->employee_id,
                        'user_id' => User::where('role', 'admin')->first()->id
                    ]);
                    // MailService::sendIncrementEmail($increment->employee->user_id ?? NULL, $increment->time_period, $increment->increment_amount, $increment->employee->salaryFormula->basic_salary ?? '0');
                }
            }
        }
    }
}
