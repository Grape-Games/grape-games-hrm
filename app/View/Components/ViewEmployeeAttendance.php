<?php

namespace App\View\Components;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
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

    function convertToHoursMins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $employeeId = Employee::where('user_id', auth()->id())->value('id');
        $todayPunches = Attendance::where('employee_id', $employeeId)
            ->whereDay('attendance', Carbon::now()->day)->get();

        if (count($todayPunches) == 1)
            $time = Carbon::parse($todayPunches[0]->attendance)->diffInMinutes(Carbon::now());
        else if (count($todayPunches) > 1)
            $time = Carbon::parse($todayPunches[0]->attendance)->diffInMinutes($todayPunches[count($todayPunches) - 1]->attendance);
        else
            $time = 0;

        $minutes = $this->convertToHoursMins($time);

        return view(
            'components.view-employee-attendance',
            [
                'todayPunches' => $todayPunches,
                'today' => Carbon::now()->format('F j, Y, g:i a'),
                'minutes' => $minutes,
                'years' => range(1990, strftime('%Y', time()))
            ]
        );
    }
}
