<?php

namespace App\View\Components;

use App\Models\BiometricDevice;
use App\Models\Company;
use App\Models\Designation;
use Illuminate\View\Component;

class EmployeePersonalInformationComponent extends Component
{
    public $number;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.employee-personal-information-component', [
            'companies' => Company::all(),
            'designations' => Designation::all(),
            'devices' => BiometricDevice::all(),
            'registration_no' => $this->number
        ]);
    }
}
