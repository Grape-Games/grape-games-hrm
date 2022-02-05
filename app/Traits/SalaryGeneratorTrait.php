<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\SalarySlip;
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
        return Employee::all();
    }

    public function getMonthHolidays($month)
    {
        return Holiday::whereMonth('date', $month)->get();
    }

    public function countSatSunInAMonthExcludingHolidays($month)
    {
        $resultArr = [
            'saturdays' => 0,
            'sundays' => 0,
        ];
        $thisMonthDays = $this->generateDateRange($month->startOfMonth(), Carbon::now());
        foreach ($thisMonthDays as $singleDay) {
            if (!Holiday::where('date', $singleDay)->exists()) {
                $parsed = Carbon::parse($singleDay);
                if ($parsed->dayOfWeek == Carbon::SATURDAY)
                    $resultArr['saturdays']++;
                else if ($parsed->dayOfWeek == Carbon::SUNDAY)
                    $resultArr['sundays']++;
            }
        }
        return $resultArr;
    }
    public function generateMonthlySlipOfAllEmployeesCron()
    {
        $satSuns = $this->countSatSunInAMonthExcludingHolidays(Carbon::now());
        $employees = $this->getAllEmployees();
        $thisMonthHolidays = count($this->getMonthHolidays(Carbon::now()->month));
        foreach ($employees as $key => $employee) {
            $attendance = Attendance::where('employee_id', $employee->id)
                ->whereMonth('attendance', Carbon::now()->month)
                ->whereYear('attendance', Carbon::now()->year)
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });
            foreach ($attendance as $key => $day) {
                if (Holiday::where('date', $key)->exists()) {
                    $thisMonthHolidays--;
                }
            }
            $monthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
            $totalDaysSalary = count($attendance) + $thisMonthHolidays + $satSuns['saturdays'] + $satSuns['sundays'];
            $monthYear = Carbon::now()->format('Y-M');
            if (!is_null($employee->salaryFormula)) {
                SalarySlip::updateOrCreate([
                    'employee_id'    => $employee->id,
                    'month_year' => $monthYear,
                ], [
                    'per_day' => $employee->salaryFormula->per_day,
                    'per_hour' => $employee->salaryFormula->per_hour,
                    'per_minute' => $employee->salaryFormula->per_minute,
                    'basic_salary' => $employee->salaryFormula->basic_salary,
                    'house_allowance' => $employee->salaryFormula->house_allowance,
                    'mess_allowance' => $employee->salaryFormula->mess_allowance,
                    'travelling_allowance' => $employee->salaryFormula->travelling_allowance,
                    'medical_allowance' => $employee->salaryFormula->medical_allowance,
                    'eid_allowance' => NULL,
                    'other_allowance' => NULL,
                    'advance_salary' => NULL,
                    'electricity' => NULL,
                    'arrears' => NULL,
                    'income_tax' => NULL,
                    'total_days' => count($monthDays),
                    'present_days' => count($attendance),
                    'absent_days' => count($monthDays) - count($attendance) + $thisMonthHolidays,
                    'holidays' => $thisMonthHolidays,
                    'salary_days' => count($attendance) + $thisMonthHolidays + $satSuns['saturdays'] + $satSuns['sundays'],
                    'calculated_salary' => $employee->salaryFormula->per_day * $totalDaysSalary,
                    'saturdays_included' => $satSuns['saturdays'],
                    'sundays_included' => $satSuns['sundays'],
                    'employee_id' => $employee->id,
                    'owner_id' => NULL
                ]);
            }
        }
        return 'sab ki hogyi';
    }
}
