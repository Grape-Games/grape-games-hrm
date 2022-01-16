<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\View\Component;

class ModalAddEmployeeHrmAccountComponent extends Component
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
        return view('components.modal-add-employee-hrm-account-component', [
            'employees' => Employee::where('user_id', NULL)->get(),
        ]);
    }
}
