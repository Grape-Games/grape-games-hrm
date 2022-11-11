<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\EmployeeAdditionalInformation;
use App\Models\EmployeeBankDetails;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeLeaves;
use App\Models\EmployeeSalaryStatus;
use App\Models\Event;
use App\Models\LeaveType;
use App\Models\Evalutation;
use App\Models\Holiday;
use App\Models\NoticeBoard;
use Carbon\Carbon;
use Illuminate\View\Component;

class DashboardEmployeeFirstComponent extends Component
{
    public $increment;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $empId = Employee::where('user_id', auth()->id())->value('id');
        $this->increment = EmployeeSalaryStatus::where('employee_id', $empId)->latest()->first();
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
        $date = now();
        $birthdays = EmployeeAdditionalInformation::whereMonth('dob', '>', $date->month)
            ->orWhere(function ($query) use ($date) {
                $query->whereMonth('dob', '=', $date->month)
                    ->whereDay('dob', '>=', $date->day);
            })
            ->orderByRaw("DATE_FORMAT(dob,'%m%d')")
            ->take(3)->get();
        $evaluations = Evalutation::where(['employee_id' => $user->id,'status' => 1])->latest()->limit(3)->get();
        $Holidays = Holiday::with('sandwich')->latest()->limit(10)->get();
        return view('components.dashboard-employee-first-component', [
            'events' => $events,
            'birthdays' => $birthdays,
            'leavesTaken' => $leaveTaken,
            'leavesAllowed' => $leavesAllowed,
            'user' => $user,
            'dp' => auth()->user(),
            'notices' => NoticeBoard::latest()->take(3)->get(),
            'evaluations' => $evaluations,
            'Holidays' => $Holidays,  
        ]);
    }
}
