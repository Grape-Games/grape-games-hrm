<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceaController extends Controller
{
    public function convertToHoursMins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
    public function index(Request $request)
    {
        if ($request->filled(['month', 'year'])) {
            $employeeId = Employee::where('user_id', auth()->id())->value('id');
            $result = Attendance::where('employee_id', $employeeId)
                ->whereMonth('attendance', Carbon::parse($request->month)->month)
                ->whereYear('attendance', $request->year)
                ->orderBy('attendance', 'DESC')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });

            return view('pages.attendance.employee.index', [
                'result' => $result
            ]);
        }
        return view('pages.attendance.employee.index');
    }
    public function requestIndex()
    {
        return view('pages.attendance.employee.request');
    }
}
