<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\BiometricDevice;
use App\Models\Employee;

class DeviceToDatabaseService
{
    public static function saveAttendanceToDatabase($attendances, $deviceIp)
    {
        if (!is_null($device = BiometricDevice::where('ip_address', $deviceIp)->first())) {
            foreach ($attendances as $key => $value) {
                $employee = Employee::where('enrollment_no', $value['id'])->first();
                if (!is_null($employee)) {
                    Attendance::create([
                        'employee_id' => $employee->id,
                        'biometric_device_id' => $device->id,
                        'state' => $value['state'],
                        'attendance' => $value['timestamp'],
                        'type' => $value['type'],
                    ]);
                }
            }
            return JsonResponseService::getJsonSuccess('Attendance was added to the database.');
        }
        return JSONResponseService::getJsonFailed('Failed to add attendance to the database.');
    }
}
