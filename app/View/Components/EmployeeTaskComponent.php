<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use App\Models\task;
use App\Models\Employee;


class EmployeeTaskComponent extends Component
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
        $user_id =  Auth::user()->id;
        $emp_id = Employee::where('user_id',Auth::user()->id)->pluck('id')->first();
        $result = task::with('user','employee','project')->where('assigned_to',$emp_id)->get();
        return view('components.employee-task-component',[
            //    'result' => $result,
               'result' => $result,
        ]); 
    }
}
