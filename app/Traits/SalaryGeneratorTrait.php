<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\Holiday;
use App\Models\LateMinutes;
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
                    return $date->attendance->format('Y-m-d');
                });
            foreach ($attendance as $key => $day) {
                if (Holiday::where('date', $key)->exists()) {
                    $thisMonthHolidays--;
                }
                if ($day[0]->attendance->diffInHours($day[count($day) - 1]->attendance) < 8) {
                    $parsedAtt = Carbon::parse(Carbon::now()->format('Y-m-d') . $day[0]->attendance->format("H:i:s"));
                    $parseCompanyTimeIn = Carbon::parse(Carbon::now()->format('Y-m-d') . $day[0]->employee->company->time_in)->addMinutes($day[0]->employee->company->grace_minutes);
                    if ($parsedAtt->gt($parseCompanyTimeIn)) {
                        $minutes = $parsedAtt->diffInMinutes($parseCompanyTimeIn);
                        LateMinutes::updateOrCreate(['date' => Carbon::parse($day[0]->attendance)->format("Y-m-d"), 'employee_id' => $employee->id], [
                            'employee_id' => $employee->id,
                            'month' => Carbon::parse($day[0]->attendance)->format("Y-M"),
                            'date' =>  Carbon::parse($day[0]->attendance)->format("Y-m-d"),
                            'minutes' => $minutes,
                            'type' => (count($day) <= 1 || $minutes > 300)  ? 'half_day' : 'morning'
                        ]);
                    }
                    // this section is to check whether the employee left early.
                    // if (count($day) > 1) {
                    //     $parsedAttOut = Carbon::parse(Carbon::now()->format('Y-m-d') . $day[count($day) - 1]->attendance->format("H:i:s"));
                    //     $parseCompanyTimeOut = Carbon::parse(Carbon::now()->format('Y-m-d') . $day[0]->employee->company->time_out);

                    //     if ($parsedAttOut->gt($parseCompanyTimeOut)) {
                    //         // return 'i left late';
                    //     } else {
                    //         LateMinutes::firstOrCreate(['date' => $day[count($day) - 1]->attendance], [
                    //             'employee_id' => $employee->id,
                    //             'month' => Carbon::now()->format('Y-M'),
                    //             'date' => $day[count($day) - 1]->attendance,
                    //             'minutes' => $parsedAttOut->diffInMinutes($parseCompanyTimeOut),
                    //             'type' => 'evening'
                    //         ]);
                    //     }
                    // }
                }
            }

            $monthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
            $totalDaysSalary = count($attendance) + $thisMonthHolidays + $satSuns['saturdays'] + $satSuns['sundays'] + EmployeeLeaves::approved($employee->user_id, Carbon::now()->month);
            $monthYear = Carbon::now()->format('Y-M');
            $employeeHalfDays = 0;
            if (!is_null($employee->salaryFormula)) {
                $calculatedSalary =  ($employee->salaryFormula->basic_salary / Carbon::now()->daysInMonth) * $totalDaysSalary;
                $calculatedSalaryWithOutDeduction = $calculatedSalary;
                if ($employee->company->late_minutes_deduction) {
                    $lateMinutes = LateMinutes::where('employee_id', $employee->id)->where('month', Carbon::now()->format('Y-M'))->where('type', '!=', 'half_day')->sum('minutes');
                    $employeeHalfDays = LateMinutes::employeeHalfDays($employee->id)->count();
                    if (isset($employee->salaryFormula->per_day)) {
                        $deductHalfDaysSalary = ($employee->salaryFormula->per_day) * $employeeHalfDays;
                    }
                    $calculatedSalary -= ($lateMinutes * ($employee->salaryFormula->per_minute ?? 0)) + ($deductHalfDaysSalary / 2);
                }
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
                    'calculated_salary' => $calculatedSalary,
                    'calculated_salary_without_deduction' => $calculatedSalaryWithOutDeduction,
                    'saturdays_included' => $satSuns['saturdays'],
                    'sundays_included' => $satSuns['sundays'],
                    'half_days' => $employeeHalfDays,
                    'employee_id' => $employee->id,
                    'owner_id' => NULL
                ]);
            }
        }
        return 'wah kia bat hai!!';
    }
}
