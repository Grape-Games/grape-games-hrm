<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

trait SalaryGeneratorTrait
{
    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public function getAllEmployees()
    {
        return Employee::with('salaryFormula')->get();
    }
    public function generateMonthlySlipOfAllEmployeesCron()
    {
        $employees = $this->getAllEmployees();
        foreach ($employees as $key => $employee) {
            # code...
            $thisMonthDaysPresence = [];
            $attendance = Attendance::where('employee_id', $employee->id)
                ->whereMonth('attendance', Carbon::now()->month)
                ->whereYear('attendance', Carbon::now()->year)
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });
            $monthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
            $payableDays = count($attendance);
            $daysDeduct = count($monthDays) - $payableDays;
            array_push(
                $thisMonthDaysPresence,
                [
                    'employee' => $employee,
                    'monthDays' => $monthDays,
                    'attedance' => $attendance,
                    'daysDeduct' => $daysDeduct,
                    'payableDays' => count($attendance)
                ]
            );
            return $thisMonthDaysPresence;
        }
    }
}
