<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\View\Component;

class ModalAddEmployeeLeaveComponent extends Component
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
        return view('components.modal-add-employee-leave-component', [
            'leave_types' => LeaveType::all(),
            'employees' => Employee::all(),
        ]);
    }
}
