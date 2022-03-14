<?php

namespace App\Console;

use App\Console\Commands\DatabaseBackUp;
use App\Console\Commands\SalarySlipGenerator;
use App\Console\Commands\ZkTecoCronCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        ZkTecoCronCommand::class,
        DatabaseBackUp::class,
        SalarySlipGenerator::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('zkteco:fetch')->hourly();

        // command to back up mySql daily.
        $schedule->command('database:backup')->daily();

        // command to update probabtion period or statuses
        $schedule->command('employee:salary')->hourlyAt(15);

        // command to generate/update the salary slip of employee on daily basis
        $schedule->command('generate:slip')->dailyAt('23:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
