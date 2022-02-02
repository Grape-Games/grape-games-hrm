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
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public function index(Request $request)
    {
        if ($request->filled(['employee_id', 'year', 'month'])) {
            $employeeArrays = [];
            $thisMonthDays = $this->generateDateRange(
                Carbon::parse($request->month . '-' . $request->year)->startOfMonth(),
                Carbon::parse($request->month . '-' . $request->year)->endOfMonth()
            );
            array_push(
                $employeeArrays,
                Attendance::where('employee_id', $request->employee_id)
                    ->whereMonth('attendance', Carbon::parse($request->month . '-' . $request->year)->month)
                    ->whereYear('attendance', $request->year)
                    ->with(['employee'])->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->attendance)->format('Y-m-d');
                    })
            );
        } else {
            $employeeArrays = [];
            $thisMonthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
            $employeeId = Employee::pluck('id');
            foreach ($employeeId as $key => $value) {
                array_push(
                    $employeeArrays,
                    Attendance::where('employee_id', $value)
                        ->whereMonth('attendance', Carbon::now()->month)
                        ->with(['employee'])->get()
                        ->groupBy(function ($date) {
                            return Carbon::parse($date->attendance)->format('Y-m-d');
                        })
                );
            }
        }
        return view('pages.admin.attendance.index', [
            'monthDays' => $thisMonthDays,
            'monthlyAttendance' => $employeeArrays,
            'years' => range(1990, strftime('%Y', time())),
            'employees' => Employee::all()
        ]);
    }
}
