<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminAttendanceManagementController extends Controller
{
    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('d');
        }

        return $dates;
    }

    public function index()
    {
        $thisMonthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
        $multipleArrays = [];
        $formattedDatesArr = [];
        $employeeArrays = [];
        $employeeId = Employee::pluck('id');
        foreach ($employeeId as $key => $value) {
            array_push(
                $employeeArrays,
                Attendance::where('employee_id', $value)
                    ->whereMonth('created_at', Carbon::now()->month)->with(['employee'])->get()

            );
        }
        return ($employeeArrays);
        $thisMonthDaysPresence = Attendance::where('employee_id', $employeeId)
            ->whereMonth('created_at', Carbon::now()->month)->pluck('attendance');
        // $formattedDatesPresence = $thisMonthDaysPresence->map(function ($date) {
        //     return $date->format('Y-m-d');
        // });
        foreach ($thisMonthDaysPresence as $key => $value) {
            array_push($formattedDatesArr, Carbon::parse($value)->format('Y-m-d'));
        }

        foreach ($thisMonthDays as $singleDay) {

            if (in_array($singleDay, $formattedDatesArr)) {
                array_push($multipleArrays, [$singleDay, 'Present', 'P']);
            } else {
                $parsed = Carbon::parse($singleDay);
                if ($parsed->dayOfWeek == Carbon::SUNDAY || $parsed->dayOfWeek == Carbon::SATURDAY) {
                    array_push($multipleArrays, [$singleDay, 'Weekend', 'H']);
                } else {
                    array_push($multipleArrays, [$singleDay, 'Absent', 'A']);
                }
            }
        }
        return view('pages.admin.attendance.index', [
            'monthDays' => $thisMonthDays
        ]);
    }
}
