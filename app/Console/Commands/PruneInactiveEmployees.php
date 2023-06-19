<?php

namespace App\Console\Commands;

use App\Enums\EmployeeStatusEnum;
use App\Models\Employee;
use Illuminate\Console\Command;

class PruneInactiveEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prune:employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This sets the status of employees to inactive if they have not registered any attendance for the past one month.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Employee::whereDoesntHave('attendances', function ($query) {
            $query->where('attendance', '>=', now()->subMonth());
        })
            ->get()
            ->each(fn ($employee) => $employee->setStatus(EmployeeStatusEnum::INACTIVE));

        return 0;
    }
}
