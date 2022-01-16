<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\View\Component;

class DashboardCardsFirstAdminComponent extends Component
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
        return view('components.dashboard-cards-first-admin-component',[
            'employees' => Employee::all(),
        ]);
    }
}
