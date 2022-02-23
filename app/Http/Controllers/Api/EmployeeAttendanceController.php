<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceController extends Controller
{
    public function save(Request $request)
    {
        if ($request->filled(['punch_in_time', 'device_id', 'employee_id'])) {
            Attendance::firstOrCreate([
                'attendance' => $request->day_attendance . ' ' . $request->punch_in_time,
                'employee_id' => $request->employee_id,
                'biometric_device_id' => $request->device_id
            ]);
        }
        if ($request->filled(['punch_out_time', 'device_id', 'employee_id'])) {
            Attendance::firstOrCreate([
                'attendance' => $request->day_attendance . ' ' . $request->punch_out_time,
                'employee_id' => $request->employee_id,
                'biometric_device_id' => $request->device_id
            ]);
        }
        session()->flash('message', 'Successfully done the operation.');
        return back();
    }
    public function get(Request $request)
    {
        return Attendance::where('employee_id', $request->id)->whereDate('attendance', $request->date)->get();
    }
}
