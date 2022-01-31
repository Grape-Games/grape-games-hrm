<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class EmployeeBarChartComponent extends Component
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
        $data = array();
        for ($i = 4; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            array_push($data, array(
                'month' => $month->shortMonthName,
                'year' => $year
            ));
        }
        return view(
            'components.employee-bar-chart-component',
            ['dataBarChart' => $data]
        );
    }
}
