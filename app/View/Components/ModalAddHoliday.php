<?php

namespace App\View\Components;
use App\Models\SandWichRule;
use Illuminate\View\Component;

class ModalAddHoliday extends Component
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
        
        return view('components.modal-add-holiday',[
            'results' => SandWichRule::where('status',1)->get(),
        ]);
    }
}
