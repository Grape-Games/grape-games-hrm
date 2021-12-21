<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmployeeBankDetailsComponent extends Component
{
    public $employee;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.employee-bank-details-component');
    }
}
