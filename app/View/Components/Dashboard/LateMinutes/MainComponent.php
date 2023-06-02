<?php

namespace App\View\Components\Dashboard\LateMinutes;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\Component;

class MainComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $employees, $companies;
    public function __construct()
    {
        $this->employees = Employee::all();
        $this->companies = Company::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.late-minutes.main-component');
    }
}
