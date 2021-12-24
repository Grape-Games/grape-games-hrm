<?php

namespace App\Services;

use Exception;
use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoApiService
{

    public function getAttendance($deviceIp)
    {
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice();
            // $zk->setTime(date('Y-m-d H:i:s')); // Synchronize time
            try {
                $attendance = $zk->getAttendance();
            } catch (Exception $exception) {
                return JsonResponseService::getJsonException($exception);
            }
            sleep(1);
            $zk->enableDevice();
            $zk->disconnect();
            return JsonResponseService::getJsonSuccess($attendance);
        }
        return JsonResponseService::getJsonFailed('Failed to connect to the device.');
    }
    public function getUsers($deviceIp)
    {
        $zk = new ZKTeco($deviceIp);
        $ret = $zk->connect();
        if ($ret) {
            $zk->disableDevice();
            // $zk->setTime(date('Y-m-d H:i:s')); // Synchronize time
            try {
                $users = $zk->getUser();
            } catch (Exception $exception) {
                return JsonResponseService::getJsonException($exception);
            }
            sleep(1);
            $zk->enableDevice();
            $zk->disconnect();
            return JsonResponseService::getJsonSuccess($users);
        }
        return JsonResponseService::getJsonFailed('Failed to connect to the devices.');
    }
}
