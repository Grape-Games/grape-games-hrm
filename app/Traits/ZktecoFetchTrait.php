<?php
namespace App\Traits;

use App\Models\Attendance;
use App\Models\BiometricDevice;
use App\Models\DeviceLogs;
use App\Models\DeviceUser;
use App\Models\Employee;
use App\Services\MailService;
use Carbon\Carbon;
use Exception;
use Rats\Zkteco\Lib\ZKTeco;

trait ZktecoFetchTrait
{
    public function fetchAttendance(){
        try {
            if (DeviceLogs::all()->count() > 10000)
                DeviceLogs::truncate();
            $devices = BiometricDevice::all();
            foreach ($devices as $device) {
                $zk = new ZKTeco($device->ip_address);
                $ret = $zk->connect();

                if ($ret) {
                    $zk->disableDevice();
                    //$zk->setTime(Carbon::now()->format('Y-m-d H:i:s'));
                    $users = $zk->getUser();
                    $time = $zk->getTime();
                    $attendances = $zk->getAttendance();
                    sleep(1);
                    $zk->getTime();
                    $zk->enableDevice();
                    $zk->disconnect();

                    // dd($users, $device->ip_address);
                    foreach ($users as $user) {
                        DeviceUser::firstOrCreate([
                            'enrollment_no' => $user['userid'],
                            'name' => $user['name'],
                            'device_id' => $device->id,
                        ]);
                    }
                    foreach ($attendances as $key => $value) {
                        $employee = Employee::where('enrollment_no', $value['id'])->first();
                        if (!is_null($employee)) {
                            $value['timestamp'] = Carbon::parse($value['timestamp']); // adding  hours to equal Pak time
                            Attendance::firstOrCreate([
                                'employee_id' => $employee->id,
                                'biometric_device_id' => $device->id,
                                'attendance' => $value['timestamp'],
                            ]);
                        }
                    }
                    DeviceLogs::create([
                        'details' => 'Attendance and users were saved successfully from the cron job.',
                        'type' => 'success',
                        'action' => 'resolved',
                        'device_id' => $device->id,
                    ]);
                    // MailService::sendZkSuccess('Saved the attendance and users.', $device->ip_address);
                } else {
                    MailService::sendZkError('Failed to create connection to the device.', $device->ip_address);
                    DeviceLogs::create([
                        'details' => 'Failed to connect to zk device .',
                        'type' => 'error',
                        'action' => 'not resolved',
                        'device_id' => $device->id,
                    ]);
                }
            }
        } catch (Exception $e) {
            MailService::sendZkError($e->getMessage(), $device->ip_address);
            DeviceLogs::create([
                'details' => 'Failed to connect to zk device : ' . $e->getMessage(),
                'type' => 'error',
                'action' => 'not resolved',
                'device_id' => $device->id,
            ]);
        }
    }
}
