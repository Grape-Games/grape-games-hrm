<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\EmployeeAdditionalInformation;
use App\Models\EmployeeBankDetails;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeLeaves;
use App\Models\Event;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\View\Component;

class DashboardEmployeeFirstComponent extends Component
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
        $user = Employee::where('user_id', auth()->id())->with(['company', 'designation', 'owner', 'bank', 'additional', 'emergency'])->first();
        $leaveTaken = EmployeeLeaves::where('owner_id', auth()->user()->id)
            ->where('status', 'approved')
            ->where('year', date("Y"))
            ->sum('number_of_leaves');
        $leavesAllowed = LeaveType::sum('allowed');
        $events = Event::where('start_time', '>', Carbon::now())->orderBy('start_time', 'ASC')->limit(2)->get();
        $birthdays = EmployeeAdditionalInformation::select('dob', 'employee_id')
            ->with(['employee' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])->limit(3)->orderBy('dob', 'ASC')->get();
        return view('components.dashboard-employee-first-component', [
            'events' => $events,
            'birthdays' => $birthdays,
            'leavesTaken' => $leaveTaken,
            'leavesAllowed' => $leavesAllowed,
            'user' => $user,
        ]);
    }
}
