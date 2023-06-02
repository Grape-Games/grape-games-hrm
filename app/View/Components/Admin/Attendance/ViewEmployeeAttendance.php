<?php

namespace App\View\Components\Admin\Attendance;

use Illuminate\View\Component;

class ViewEmployeeAttendance extends Component
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
        return view('components.admin.attendance.view-employee-attendance');
    }
}
