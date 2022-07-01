<?php

namespace App\Console\Commands;

use App\Traits\ZktecoFetchTrait;
use Illuminate\Console\Command;

class ZkTecoCronCommand extends Command
{
    use ZktecoFetchTrait;

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
        $this->info("Started fetching");
        $this->fetchAttendance();
        $this->info("Ended fetching");
        return Command::SUCCESS;
    }
}
