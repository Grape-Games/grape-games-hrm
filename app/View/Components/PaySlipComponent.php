<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaySlipComponent extends Component
{

    public $salaryDetails;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($salaryDetails)
    {
        $this->salaryDetails = $salaryDetails;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pay-slip-component');
    }
}
