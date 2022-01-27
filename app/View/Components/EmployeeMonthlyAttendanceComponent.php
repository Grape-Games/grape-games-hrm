<?php

namespace App\View\Components;

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
        $thisMonthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $multipleArrays = [];
        $strCat = "";
        foreach ($thisMonthDays as $singleDay) {
            array_push($multipleArrays, [$singleDay, '', 'P']);
            $strCat .= '"d-' . $singleDay . '":{ backgroundColor: "#55ce63",},';
        }
        return view('components.employee-monthly-attendance-component', [
            'dates' => $multipleArrays,
            'strCat' => $strCat
        ]);
    }
}
