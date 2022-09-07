<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Employee;
use Auth;
class ModalAddLoanComponent extends Component
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
        return view('components.modal-add-loan-component',[
            'user_id' => Auth::user()->id,
            'employees'=> Employee::all(),
        ]);
    }
}
