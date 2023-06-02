<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LateMinutes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceController extends Controller
{
    public function save(Request $request)
    {
        $message = "";
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
        if (Attendance::where('employee_id', $request->employee_id)->whereDate('attendance', $request->day_attendance)->count() > 1) {
            LateMinutes::where('date', $request->day_attendance)->where('employee_id', $request->employee_id)->forceDelete();
            $message = "Late minutes also deleted.";
        }

        // session()->flash('message', 'Operation successful. ' . $message);
        // return back();

        return response()->json("Record updated, please refresh to reflect changes on screen.");
    }
    public function get(Request $request)
    {
        return Attendance::where('employee_id', $request->id)->whereDate('attendance', $request->date)->get();
    }
}
