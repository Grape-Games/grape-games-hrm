<?php

use App\Models\Attendance;
use App\Models\Loan; 
use App\Models\LoanInstallment; 
use App\Models\EmployeeBonus; 
use App\Models\Deduction; 
use App\Models\Increment; 
use App\Models\SandWichRule;
use App\Models\LateMinutes; 
use App\Models\EmployeeSalarySlip; 
use Carbon\Carbon;
use App\Models\Holiday;

function employeeAttendances($employee, $searchDate)
{
    return Attendance::where('employee_id', $employee->id)
        ->whereMonth('attendance', $searchDate->month)
        ->whereYear('attendance', $searchDate->year)
        ->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
            return Carbon::parse($date->attendance)->format('Y-m-d');
        });
}

function getEmployeeLateMinutesByAttendances($employee, $attendances, $salary)
{
    $companyTimeIn = Carbon::parse($employee->company->time_in)->addMinutes($employee->company->grace_minutes)->format('H:i');
    $companyTimeOut = Carbon::parse($employee->company->time_out)->format('H:i');

    $totalLateMinutesMorning = [];
    $totalLateMinutesMorningCounter = 0;
    $totalLateMinutesEvening = [];
    $totalLateMinutesEveningCounter = 0;

    $halfDays = 0;
    $halfDaysArr = [];

    foreach ($attendances as $key => $perDayPunches) {

        // counting employees half days if punch out is missing
        if (count($perDayPunches) <= 1) { {
                array_push($halfDaysArr, $perDayPunches);
                $halfDays++;
            }
        } else {

            $dummyCompanyTimeIn = Carbon::parse(Carbon::now()->format('Y-m-d') . " " . $companyTimeIn);
            // $dummyCompanyTimeOut = Carbon::parse(Carbon::now()->format('Y-m-d') . " " . $companyTimeOut);

            $dummyAttendanceTimeIn = Carbon::parse(Carbon::now()->format('Y-m-d') . " " . $perDayPunches[0]->attendance->format("H:i:s"));
            // $dummyAttendanceTimeOut = Carbon::parse(Carbon::now()->format('Y-m-d') . " " . $perDayPunches[count($perDayPunches) - 1]->attendance->format("H:i:s"));

            if ($dummyAttendanceTimeIn->gt($dummyCompanyTimeIn)) {
                // matleb wo subha late aya hai
                $mins = $dummyAttendanceTimeIn->diffInMinutes($dummyCompanyTimeIn);

                if ($mins > 180) { {
                        array_push($halfDaysArr, $perDayPunches);
                        $halfDays++;
                    }
                } else {
                    array_push($totalLateMinutesMorning, [
                        "date" => $perDayPunches[0]->attendance->format("Y-m-d H:i:s"),
                        "date_second" => $perDayPunches[0]->attendance->format("l Y-m-d h:i:s A"),
                        "minutes" => $mins
                    ]);
                    $totalLateMinutesMorningCounter += $mins;
                }
            }

            // if ($dummyAttendanceTimeOut->lt($dummyCompanyTimeOut)) {
            //     // matlab wo jldi chla gya hai
            //     $mins = $dummyAttendanceTimeOut->diffInMinutes($dummyCompanyTimeOut);
            //     if ($mins > 240) {
            //         array_push($halfDaysArr, $perDayPunches);
            //         $halfDays++;
            //     } else {
            //         array_push($totalLateMinutesEvening, [
            //             "date" => $perDayPunches[count($perDayPunches) - 1]->attendance->format("Y-m-d H:i:s"),
            //             "date_second" => $perDayPunches[count($perDayPunches) - 1]->attendance->format("l Y-m-d h:i:s A"),
            //             "minutes" => $mins
            //         ]);
            //         $totalLateMinutesEveningCounter += $mins;
            //     }
            // }
        }
    }

    $halfDaysDeduction = $halfDays * ($salary / 2);

    $employee->company->late_minutes_deduction
        ? $lateMinuteDeductions = ($totalLateMinutesMorningCounter + $totalLateMinutesEveningCounter) * $employee->salaryFormula->per_minute
        : $lateMinuteDeductions = 0;

    return [
        "lateMinutesMorningCounter" => $totalLateMinutesMorningCounter,
        "lateMinutesEveningCounter" => $totalLateMinutesEveningCounter,
        "lateMinutesTotal" => $totalLateMinutesEveningCounter + $totalLateMinutesMorningCounter,
        "lateMinutesMorning" => $totalLateMinutesMorning,
        "lateMinutesEvening" => $totalLateMinutesEvening,
        "lateMinutesDeductions" => $lateMinuteDeductions,
        "halfDays" => $halfDays,
        "halfDaysDetails" => $halfDaysArr,
        "halfDaysDeductions" => $halfDaysDeduction,
    ];
}

function getEmployeeOverTimeHoursByAttendances($attendances): int
{
    $overtimeHours = 0;

    foreach ($attendances as $key => $perDayPunches) {
        if (count($perDayPunches) < 2)
            continue;

        $in = Carbon::parse($perDayPunches[0]->attendance);
        $out = Carbon::parse($perDayPunches[count($perDayPunches) - 1]->attendance);

        $workingHours = $in->diffInHours($out);

        if ($workingHours > 9)
            $overtimeHours += $in->diffInHours($out);
    }

    return $overtimeHours;
}

function GetEmployeeMonthlyLoan($employee, $date){
        $loan_data =  LoanInstallment::select('amount')->where('employee_id', $employee)->whereMonth('date',$date->month)->get();   
        return $loan_data->sum('amount');

}
function GetEmployeeBouns($employee, $date){
    $data = EmployeeBonus::select('amount')->where('employee_id', $employee)->where('month',$date->format('Y-m'))->get();   
    return $data->sum('amount');
}

function GetEmployeeDeduction($employee, $date){
    $data = Deduction::select('amount')->where('employee_id', $employee)->where('month',$date->format('Y-m'))->get();   
    return $data->sum('amount');
}
function GetEmployeeIncrements($employee){
    $date = Carbon::now()->format('Y-m');
   $data  = Increment::select('amount')->where('employee_id',$employee)->where('month','<=', $date)->get();
   return $data->sum('amount');
}

function GetSandWichRuleDate($searchDate,$employee){
    $SandwhichRuleDates = SandWichRule::whereMonth('date',$searchDate)->pluck('date')->toArray();
 
 $attendances = employeeAttendances(
            $employee,
            $searchDate
        );
 $attendances1 = employeeAttendances(
            $employee,
            $searchDate
        );
    
        $arr = $attendances->toArray();
        foreach ($arr as $key => $data) {
             if (($key = array_search($key, $SandwhichRuleDates)) !== false)
                unset($SandwhichRuleDates[$key]); 
               
        }
    $dates = array();
    
      foreach($SandwhichRuleDates as $Key=>$data){  
         $sand_wich_id = SandWichRule::where('date',$data)->pluck('id')->first();
         $holiday = Holiday::where('sandwich_id',$sand_wich_id)->get();
         foreach($holiday as $dd){
             $dates[] = $dd;
             }
        }
         
    return $dates;   
    
}


function SetRatingStars($star){
   if($star == 1){
       return "★☆☆☆☆";
   }else if($star == 2){
          return "★★☆☆☆";
   
   }else if($star == 3){
          return "★★★☆☆";
  
   }else if($star == 4){
          return "★★★★☆";
  
   }else if($star == 5){
          return "★★★★★";
   }else {
       return "☆☆☆☆☆";
   }
}

function RatingPercentage($total_rating){
    $percent = $total_rating * 100 / 25;
    if($percent > 100){
     $percent = 100;
    }
    return $percent;
}
