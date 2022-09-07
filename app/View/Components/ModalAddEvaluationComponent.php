<?php

namespace App\View\Components;
use App\Models\Employee;
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
        return view('components.modal-add-evaluation-component',[
         'user_id' => Auth::user()->id,
         'employees'=> Employee::all(),
    ]);
    }
}
