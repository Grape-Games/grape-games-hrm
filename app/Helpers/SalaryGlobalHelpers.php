<?php

use App\Models\Attendance;
use Carbon\Carbon;


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

                if ($mins > 240) { {
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
