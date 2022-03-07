<?php

namespace App\Http\Livewire\Dashboard\Admin\EmployeeSalaryIncrements\Modals;

use App\Models\EmployeeSalaryStatus;
use Livewire\Component;

class ViewHistory extends Component
{
    protected $listeners = ['viewHistory'];

    public $employeeName, $details = [];

    public function viewHistory($employeeId)
    {
        $this->details = EmployeeSalaryStatus::where('employee_id', $employeeId)->get();
    }

    public function render()
    {
        return view('livewire.dashboard.admin.employee-salary-increments.modals.view-history');
    }
}
