<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\BiometricDevice;
use App\Models\DeviceLogs;
use App\Models\DeviceUser;
use App\Models\Employee;
use App\Services\JsonResponseService;
use App\Services\MailService;
use App\Services\ZKTecoApiService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Rats\Zkteco\Lib\ZKTeco;

class ZkTecoCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zkteco:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches the data from a zkteco device and stores it in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
                    MailService::sendZkSuccess('Saved the attendance and users.', $device->ip_address);
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
        return Command::SUCCESS;
    }
}
