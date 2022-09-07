<?php

namespace App\View\Components;

use App\Models\DepartmentType;
use App\Models\Employee;
use Illuminate\View\Component;
use Auth;
use DB;

class ModalAddEmployeeBounsComponent extends Component
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
        // dd(Employees::all());
        return view('components.modal-add-employee-bouns-component',[
            'user_id' => Auth::user()->id,
            'employees'=> Employee::all(),
           
        ]);
    }
}
