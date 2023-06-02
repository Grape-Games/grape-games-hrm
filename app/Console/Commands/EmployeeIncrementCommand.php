<?php

namespace App\Console\Commands;

use App\Traits\EmployeeSalaryUpdatesTrait;
use Illuminate\Console\Command;

class EmployeeIncrementCommand extends Command
{
    use EmployeeSalaryUpdatesTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is to add increments to employee salaries after applied date';

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
        // fake populating entry for new employees
        $this->fakePopulate();

        // business logic
        $this->updateEmployeeSalaries();

        $this->info('Job successfully executed');

        return Command::SUCCESS;
    }
}
