<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\BiometricDevice;
use App\Models\DeviceUser;
use App\Models\Employee;
use Carbon\Carbon;

class DeviceToDatabaseService
{
    public static function saveAttendanceToDatabase($attendances, $deviceIp)
    {
        if (!is_null($device = BiometricDevice::where('ip_address', $deviceIp)->first())) {
            foreach ($attendances as $key => $value) {
                $employee = Employee::where('enrollment_no', $value['deviceUserId'])->first();
                if (!is_null($employee)) {
                    $value['recordTime'] = Carbon::parse($value['recordTime'])->addHours(5); // adding  hours to equal Pak time
                    Attendance::firstOrCreate([
                        'employee_id' => $employee->id,
                        'biometric_device_id' => $device->id,
                        'attendance' => $value['recordTime'],
                    ]);
                }
            }
            return [
                'status' => 200,
                'message' => 'Attendance was added/updated successfully.'
            ];
        }
        return [
            'status' => 400,
            'message' => 'This device does not exists in the database.'
        ];
    }

    public static function saveUsersToDatabase($users, $deviceIp)
    {
        if (!is_null($device = BiometricDevice::where('ip_address', $deviceIp)->first())) {
            foreach ($users as $key => $value) {
                DeviceUser::firstOrCreate([
                    'enrollment_no' => $value['userId'],
                    'name' => $value['name'],
                    'device_id' => $device->id,
                ]);
            }
            return [
                'status' => 200,
                'message' => 'Users were added/updated successfully.'
            ];
        }
        return [
            'status' => 400,
            'message' => 'This device does not exists in the database.'
        ];
    }
}
