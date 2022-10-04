<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
class ModalAddProjectComponent extends Component
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

        return view('components.modal-add-project-component',[
            'user_id' => Auth::user()->id,
        ]);
    }
}
