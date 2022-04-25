<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\Holiday;
use App\Models\LateMinutes;
use Carbon\Carbon;

trait AttendanceTraitSalary
{
    public function getEmployeeAttedanceByMonth($employeeId, $month, $companyId)
    {
        if ($employeeId == "all") {
            $resultArr = [];
            $employees = Employee::companies($companyId)->pluck('id');
            foreach ($employees as $key => $value) {
                $hd = [];
                $data = Attendance::where('employee_id', $value)
                    ->whereMonth('attendance', $month)->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                        return Carbon::parse($date->attendance)->format('Y-m-d');
                    });
                foreach ($data as $key => $value2) {
                    # code...
                    if (count($value2) == 1)
                        array_push($hd, ['half_day' => $value2[0]->attendance]);
                }
                $data->hd = $hd;
                $data->holidays = Holiday::whereMonth('date', $month)->count();
                $data->leaves_approved = EmployeeLeaves::where('owner_id', $value)->whereStatus('approved')->count();
                $data->lateMinutes = LateMinutes::where('employee_id', $value)->whereMonth('date', $month)->sum('minutes');
                array_push($resultArr, $data);
            }
            return $resultArr;
        } else {
            $resultArr = [];
            $hd = [];
            $data = Attendance::where('employee_id', $employeeId)
                ->whereMonth('attendance', $month)->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });
            foreach ($data as $key => $value2) {
                # code...
                if (count($value2) == 1)
                    array_push($hd, ['half_day' => $value2[0]->attendance]);
            }
            $data->hd = $hd;
            $data->holidays = Holiday::whereMonth('date', $month)->count();
            $data->leaves_approved = EmployeeLeaves::where('owner_id', $employeeId)->whereStatus('approved')->count();
            $data->lateMinutes = LateMinutes::where('employee_id', $employeeId)->whereMonth('date', $month)->sum('minutes');
            array_push($resultArr, $data);
            return $resultArr;
        }
    }
}
