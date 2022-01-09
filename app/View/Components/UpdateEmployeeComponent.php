<?php

namespace App\View\Components;

use App\Models\BiometricDevice;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\View\Component;

class UpdateEmployeeComponent extends Component
{

    public $employeeId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.update-employee-component', [
            'employee' => Employee::where('id', $this->employeeId)->with(['company', 'designation'])->first(),
            'companies' => Company::all(),
            'designations' => Designation::all(),
            'devices' => BiometricDevice::all(),
        ]);
    }
}
