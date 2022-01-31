<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\View\Component;

class ProfileTopComponent extends Component
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
        return view('components.profile-top-component', [
            'user' => Employee::where('user_id', auth()->id())->with(['company', 'designation', 'owner', 'bank', 'additional', 'emergency'])->first(),
            'dp' => auth()->user()
        ]);
    }
}
