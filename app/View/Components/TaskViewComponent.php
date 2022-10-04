<?php

namespace App\View\Components;
use App\Models\task;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class TaskViewComponent extends Component
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
        $task_id = request()->route('id');
        return view('components.task-view-component',[
            'result' =>task::with('user','employee','project')->where('id',$task_id)->first(), 
           
        ]);
    }
}
