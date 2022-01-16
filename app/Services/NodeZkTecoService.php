<?php

namespace App\Services;

use App\Models\BiometricDevice;
use App\Models\DeviceLogs;
use Exception;
use Illuminate\Http\Request;
use App\Services\JsonResponseService;

class NodeZkTecoService
{

    public function saveLogs(Request $request)
    {
        try {
            $create = DeviceLogs::create([
                'type' => $request->data[0],
                'details' => $request->data[1],
                'action' => $request->data[2],
                'device_id' => BiometricDevice::where('ip_address', $request->deviceIp)->value('id')
            ]);
            if ($create)
                return JSONResponseService::getJsonSuccess('Logs were successfully created.');
            return JSONResponseService::getJsonFailed('Failed to create logs.');
        } catch (Exception $exception) {
            return JSONResponseService::getJsonException($exception);
        }
    }

    public function saveUsersToDevice(Request $request)
    {
        try {
            $response = DeviceToDatabaseService::saveUsersToDatabase($request->data, $request->deviceIp);
            if ($response['status'] != "200")
                return JSONResponseService::getJsonFailed($response['message']);
            return JSONResponseService::getJsonSuccess('Users were added/updated successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    public function saveAttendanceToDevice(Request $request)
    {
        try {
            $response = DeviceToDatabaseService::saveAttendanceToDatabase($request->data, $request->deviceIp);
            if ($response['status'] != "200")
                return JSONResponseService::getJsonFailed($response['message']);
            return JSONResponseService::getJsonSuccess('Attendance was added/updated successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }


    public function getDevices()
    {
        return JsonResponseService::getJsonSuccess([
            'message' => 'Devices fetched successfully.',
            'devices' => BiometricDevice::all()
        ]);
    }

    public function saveDataToDevice(Request $request)
    {
        try {

            $usersResponse = DeviceToDatabaseService::saveUsersToDatabase($request->users, $request->deviceIp);
            $attendanceResponse = DeviceToDatabaseService::saveAttendanceToDatabase($request->attendances, $request->deviceIp);

            if ($usersResponse['status'] != "200")
                return JSONResponseService::getJsonFailed($usersResponse['message']);
            else if ($attendanceResponse['status'] != "200")
                return JSONResponseService::getJsonFailed($attendanceResponse['message']);
            else
                return JSONResponseService::getJsonSuccess('Records were added/updated successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }
}
