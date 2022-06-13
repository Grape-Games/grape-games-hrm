<?php

namespace App\Console\Commands;

use App\Models\BiometricDevice;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Rats\Zkteco\Lib\ZKTeco;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command backups your database.';

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
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";

        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
        // $permissions = "chmod -R 777 " . storage_path() . "/app/backup";
        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);
        // exec($permissions, $output, $returnVar);

        $devices = BiometricDevice::all();
        foreach ($devices as $device) {

            $zk = new ZKTeco($device->ip_address);
            $ret = $zk->connect();

            if ($ret) {
                $zk->disableDevice();
                $zk->clearAttendance();
            }
            sleep(1);
            $zk->getTime();
            $zk->enableDevice();
            $zk->disconnect();
        }
        return Command::SUCCESS;
    }
}
