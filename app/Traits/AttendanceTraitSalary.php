<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\Holiday;
use App\Models\LateMinutes;
use App\Models\LeaveType;
use Carbon\Carbon;

trait AttendanceTraitSalary
{
    public function getEmployeeAttedanceByMonth($employeeId, $date, $companyId)
    {
        if ($employeeId == "all") {
            $resultArr = [];
            $employees = Employee::active()->companies($companyId)->get();

            foreach ($employees as $key => $value) {

                $hd = [];
                $data = Attendance::where('employee_id', $value->id)
                    ->whereMonth('attendance', $date->month)->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                        return Carbon::parse($date->attendance)->format('Y-m-d');
                    });
                foreach ($data as $key => $value2) {
                    # code...
                    if (count($value2) == 1)
                        array_push($hd, ['half_day' => $value2[0]->attendance]);
                }
                $data->hd = $hd;
                $data->holidays = Holiday::whereMonth('date', $date->month)->whereYear('date', $date->year)->count();

                $data->lateMinutes = LateMinutes::where('employee_id', $employeeId)->whereYear('created_at', $date->year)->whereMonth('date', $date->month)->sum('minutes');
                array_push($resultArr, $data);
            }
            return $resultArr;
        } else {
            $userId = Employee::whereId($employeeId)->value('user_id');

            $resultArr = [];
            $hd = [];

            $data = Attendance::where('employee_id', $employeeId)
                ->whereMonth('attendance', $date->month)->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });
            foreach ($data as $key => $value2) {
                # code...
                if (count($value2) == 1)
                    array_push($hd, ['half_day' => $value2[0]->attendance]);
            }

            $data->hd = $hd;
            $data->holidays = Holiday::whereMonth('date', $date->month)->whereYear('date', $date->year)->count();
            $data->leaves_allowed = LeaveType::sum('allowed');
            $data->leaves_approved = EmployeeLeaves::leavesMonthly($userId, $date, 'approved');
            $data->leaves_pending = EmployeeLeaves::leavesMonthly($userId, $date, 'pending');
            $data->leaves_rejected = EmployeeLeaves::leavesMonthly($userId, $date, 'rejected');
            $data->lateMinutes = LateMinutes::where('employee_id', $employeeId)->whereYear('created_at', $date->year)->whereMonth('date', $date->month)->sum('minutes');
            array_push($resultArr, $data);
            return $resultArr;
        }
    }
}
