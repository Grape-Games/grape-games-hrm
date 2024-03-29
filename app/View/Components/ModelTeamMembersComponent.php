<?php

namespace App\View\Components;
use App\Models\Employee;
use Illuminate\View\Component;

class ModelTeamMembersComponent extends Component
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
        return view('components.model-team-members-component',[
            'employees' => Employee::with('designation')->get(),
        ]);
    }
}
