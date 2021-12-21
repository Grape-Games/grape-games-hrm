<?php

namespace App\View\Components;

use App\Models\DepartmentType;
use Illuminate\View\Component;

class ModalAddDepartmentComponent extends Component
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
        return view('components.modal-add-department-component', [
            'department_types' => DepartmentType::all(),
        ]);
    }
}
