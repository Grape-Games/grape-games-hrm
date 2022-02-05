<?php

namespace App\Console\Commands;

use App\Traits\SalaryGeneratorTrait;
use Illuminate\Console\Command;

class SalarySlipGenerator extends Command
{
    use SalaryGeneratorTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:slip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commands generates or updates the monthly salary slips of employees on daily basis.';

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
        $this->generateMonthlySlipOfAllEmployeesCron();
        return Command::SUCCESS;
    }
}
