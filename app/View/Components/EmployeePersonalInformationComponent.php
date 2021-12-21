<?php

namespace App\View\Components;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\View\Component;

class EmployeePersonalInformationComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.employee-personal-information-component', [
            'departments' => Department::all(),
            'designations' => Designation::all(),
        ]);
    }
}
