<?php

namespace App\Services;

use App\Http\Requests\JsGetDeviceUsers;
use App\Models\BiometricDevice;
use App\Models\DeviceUser;
use Carbon\Carbon;
use Exception;
use Rats\Zkteco\Lib\ZKTeco;
use App\Services\JsonResponseService;

class ZKTecoApiService 
{
    public static function getDeviceUser(JsGetDeviceUsers $request)
    {
        return JsonResponseService::getJsonSuccess(DeviceUser::where('device_id', $request->id)->get());
    }

    public static function getAttendance($deviceIp)
    {
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice();
            // $zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
            try {
                $attendance = $zk->getAttendance();
                $time = $zk->getTime();
            } catch (Exception $exception) {
                return JsonResponseService::getJsonException($exception);
            }
            sleep(1);
            $zk->getTime();
            $zk->enableDevice();
            $zk->disconnect();
            return JsonResponseService::getJsonSuccess(['time' => $time, 'attendance' => $attendance]);
        }
        return JsonResponseService::getJsonFailed('Failed to connect to the device.');
    }

    public function setAttendance($deviceIp)
    {
        $attendance = self::getAttendance($deviceIp);
        $response =  json_decode($attendance->content(), true);
        if ($response['message'] == 'success')
            return DeviceToDatabaseService::saveAttendanceToDatabase($response['response'], $deviceIp);
        return $attendance;
    }

    public function getUsers($deviceIp)
    {
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice(); 
            // $zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
            try {
                $users = $zk->getUser();
                $time = $zk->getTime();
            } catch (Exception $exception) {
                return JsonResponseService::getJsonException($exception);
            }
            sleep(1);
            $zk->getTime();
            $zk->enableDevice();
            $zk->disconnect();
            return JsonResponseService::getJsonSuccess(['time' => $time, 'users' => $users]);
        }
        return JsonResponseService::getJsonFailed('Failed to connect to the devices.');
    }

    public function getDeviceTime($deviceIp)
    {
        try {
            $zk = new ZKTeco($deviceIp);
            $ret = $zk->connect();
            if ($ret) {
                $zk->disableDevice();
                // $zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
                $time = $zk->getTime();
            }
            sleep(1);
            $zk->getTime();
            $zk->enableDevice();
            $zk->disconnect();
            return JsonResponseService::getJsonSuccess($time);
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
        return JsonResponseService::getJsonFailed('Failed to connect to the devices.');
    }

    public function restartDevice($deviceIp)
    {
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice();
            if ($zk->restart()) {
                return JsonResponseService::getJsonSuccess('Device restart successful.');
            }
            return JsonResponseService::getJsonSuccess('Device restart failed.');
        }
    }
}
