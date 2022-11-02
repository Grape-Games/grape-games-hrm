<?php

namespace App\View\Components;
use App\Models\Employee;
use App\Models\Designation;
use App\Models\TeamMember;
use Auth;
use Illuminate\View\Component;

class ModalAddEvaluationComponent extends Component
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
        $user = Auth::user();
        if(Auth::user()->role =='team_lead'){ 
            $employees = TeamMember::with('employee')->where('assigned_to',$user->id)->get(); 
        }else {
                $employees = Employee::all();
        }

        
        return view('components.modal-add-evaluation-component',[
         'user' =>  $user,
         'employees'=> $employees,  
    ]);
    }
}
