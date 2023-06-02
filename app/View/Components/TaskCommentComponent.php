<?php

namespace App\View\Components;
use App\Models\TaskComment;
use Illuminate\View\Component;

class TaskCommentComponent extends Component
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
        return view('components.task-comment-component',[
          'task_id'  => $task_id,
          'comments' => TaskComment::with('user')->where('task_id',$task_id)->get(),
        ]);
    }
}
