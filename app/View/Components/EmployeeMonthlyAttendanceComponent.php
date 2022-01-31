<?php

namespace App\View\Components;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\View\Component;

class EmployeeMonthlyAttendanceComponent extends Component
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

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $thisMonthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
        $multipleArrays = [];
        $formattedDatesArr = [];
        $employeeId = Employee::where('user_id', auth()->id())->value('id');
        $thisMonthDaysPresence = Attendance::where('employee_id', $employeeId)
            ->whereMonth('created_at', Carbon::now()->month)->pluck('attendance');
        // $formattedDatesPresence = $thisMonthDaysPresence->map(function ($date) {
        //     return $date->format('Y-m-d');
        // });
        foreach ($thisMonthDaysPresence as $key => $value) {
            array_push($formattedDatesArr, Carbon::parse($value)->format('Y-m-d'));
        }

        foreach ($thisMonthDays as $singleDay) {

            if (in_array($singleDay, $formattedDatesArr)) {
                array_push($multipleArrays, [$singleDay, 'Present', 'P']);
            } else {
                $parsed = Carbon::parse($singleDay);
                if ($parsed->dayOfWeek == Carbon::SUNDAY || $parsed->dayOfWeek == Carbon::SATURDAY) {
                    array_push($multipleArrays, [$singleDay, 'Weekend', 'H']);
                } else {
                    array_push($multipleArrays, [$singleDay, 'Absent', 'A']);
                }
            }
        }

        return view('components.employee-monthly-attendance-component', [
            'dates' => $multipleArrays,
        ]);
    }
}
