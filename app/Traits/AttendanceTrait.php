<?php

namespace App\Traits;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LateMinutes;
use Carbon\Carbon;

trait AttendanceTrait
{
    public function getEmployeeAttedanceByMonth($employeeId, $month, $companyId)
    {
        if ($employeeId == "all") {
            $resultArr = [];
            
            $employees = Employee::companies($companyId)->pluck('id');
            foreach ($employees as $key => $value) {
                $hd = 0;
                $lateMinutes =0;
                $data = Attendance::where('employee_id', $value)
                    ->whereMonth('attendance', $month)->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                        return Carbon::parse($date->attendance)->format('Y-m-d');
                    });
                foreach ($data as $key => $value2) {
                    # code...
                    if (count($value2) == 1)
                        $hd++;
                        else if(count($value2) > 1) {
                            if($this->getLateMinutesPerDay($value2) > 180){
                                $hd++; 
                            }else{
                                $lateMinutes += $this->getLateMinutesPerDay($value2);
                            }
                            // $lateMinutes += $this->getLateMinutesPerDay($value2);
                        }
                }
                $data->hd = $hd;
                $data->lateMinutes =$lateMinutes;
                // $data->lateMinutes = LateMinutes::where('employee_id', $value)->whereMonth('date', $month)->sum('minutes');
                array_push($resultArr, $data);
            }
            return $resultArr;
        } else {
            $resultArr = [];
            $hd = 0;
            $lateMinutes = 0;
            // $lateMinutes = 0;
            $data = Attendance::where('employee_id', $employeeId)
                ->whereMonth('attendance', $month)->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });
            foreach ($data as $key => $value2) {
                # code...
                if (count($value2) == 1)
                    $hd++;
                else if(count($value2) > 1){
                    if($this->getLateMinutesPerDay($value2) > 180){
                        $hd++; 
                    }else{
                        $lateMinutes += $this->getLateMinutesPerDay($value2);
                    }
                    // $lateMinutes += $this->getLateMinutesPerDay($value2);
                    
                }
            }
            $data->hd = $hd;
            $data->lateMinutes = $lateMinutes;
            // $data->lateMinutes = $lateMinutes;
            array_push($resultArr, $data);
            return $resultArr;
        }
    }

    public function getLateMinutesPerDay($dayPunches): int
    {
        $sum = 0;
        $clockOut = Carbon::parse($dayPunches[0]->employee->company->time_out);
        $clockIn = Carbon::parse($dayPunches[0]->employee->company->time_in);
        $attendance_in = Carbon::parse($dayPunches[0]->attendance->format("g:i a"));
        $attendance_out = Carbon::parse($dayPunches[count($dayPunches) - 1]->attendance->format("g:i a"));
        if ($attendance_in->gt($clockIn)) {
            $sum += Carbon::parse($clockIn)->diffInMinutes($attendance_in);
        }
        if ($clockOut->gt($attendance_out)) {
            $sum += Carbon::parse($attendance_out)->diffInMinutes($clockOut);
        }
        return $sum;
    }
}
