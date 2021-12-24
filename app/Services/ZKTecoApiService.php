<?php

namespace App\Services;

use App\Models\test;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoApiService
{

    public static function getAttendance($deviceIp)
    {
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice();
            $zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
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
            $zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
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
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice();
            $zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
            try {
                $time = $zk->getTime();
            } catch (Exception $exception) {
                return JsonResponseService::getJsonException($exception);
            }
            sleep(1);
            $zk->getTime();
            $zk->enableDevice();
            $zk->disconnect();
            return JsonResponseService::getJsonSuccess($time);
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

    public function test(Request $request)
    {
        // test::truncate();
        foreach ($request->users as $key => $value) {
            test::firstOrCreate([
                'enrollment_no' => $value['userId'],
                'name' => $value['name'],
            ]);
        }
        return JSONResponseService::getJsonSuccess([
            'message' => 'Users added successfully.',
            // 'deiceTime' => $request->time->format('Y-m-d H:i:s'),
        ]);
    }
}
