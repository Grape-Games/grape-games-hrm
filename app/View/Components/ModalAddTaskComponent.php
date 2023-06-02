<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use App\Models\project;
use App\Models\Employee;

class ModalAddTaskComponent extends Component
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
        return view('components.modal-add-task-component',[
            'projects' => project::where('status',2)->get(),
            'employees' => Employee::all(),
            'user_id' => Auth::user()->id,
        ]);
    }
}
