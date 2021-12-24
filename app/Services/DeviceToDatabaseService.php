<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;

class DeviceToDatabaseService
{
    public function saveAttendanceToDatabase($attendances)
    {
        // 'employee_id',
        // 'biometric_device_id',
        // 'state',
        // 'attendance',
        // 'type'
        // $employees
        // foreach ($attendances as $key => $value) {
        //     $employeeId = Employee::select('first_name', 'last_name')->where('enrollment_no', $value['id'])->first();
        //     Attendance::create([]);
        // }
    }
}
