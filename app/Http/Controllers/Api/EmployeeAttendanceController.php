<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

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
}
