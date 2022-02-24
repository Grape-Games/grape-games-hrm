<?php

namespace App\View\Components\Dashboard\LateMinutes;

use Illuminate\View\Component;

class ShowResult extends Component
{
    public $employee_id, $company_id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employee_id, $company_id)
    {
        $this->employee_id = $employee_id;
        $this->company_id = $company_id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.late-minutes.show-result');
    }
}
