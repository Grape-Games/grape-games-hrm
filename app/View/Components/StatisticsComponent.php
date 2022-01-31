<?php

namespace App\View\Components;

use App\Models\Attendance;
use App\Models\BiometricDevice;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\View\Component;

class StatisticsComponent extends Component
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
        return view('components.statistics-component', [
            'devices' => BiometricDevice::all()->count(),
            'events' => Event::all()->count(),
            'designations' => Designation::all()->count(),
            'departments' => Department::all()->count(),
            'employees' => Employee::all()->count(),
            'presentToday' => Attendance::whereDay('attendance', Carbon::today())->get()->groupBy('employee_id')->count()
        ]);
    }
}
