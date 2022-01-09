<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\View\Component;

class HeaderComponent extends Component
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
        $role = auth()->user()->role;
        $role == 'admin'
            ? $user = auth()->user()
            : $user = Employee::where('user_id', auth()->id())->first();
        return view('components.header-component', [
            'user' => $user,
            'role' => $role
        ]);
    }
}
