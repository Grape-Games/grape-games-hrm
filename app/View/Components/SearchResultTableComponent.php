<?php

namespace App\View\Components;

use App\Models\Employee;
use Carbon\Carbon;
use DateTime;
use Illuminate\View\Component;

class SearchResultTableComponent extends Component
{
    public $company;
    public $month;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($company, $month)
    {
        $this->company = $company;
        $this->month = $month;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    function get_weekdays($m, $y)
    {
        $lastday = date("t", mktime(0, 0, 0, $m, 1, $y));
        $weekdays = 0;
        for ($d = 29; $d <= $lastday; $d++) {
            $wd = date("w", mktime(0, 0, 0, $m, $d, $y));
            if ($wd > 0 && $wd < 6) $weekdays++;
        }
        return $weekdays + 20;
    }


    public function render()
    {
        $dt = DateTime::createFromFormat('Y-m', $this->month);
        $days = Carbon::parse($dt->format('Y-m'))->daysInMonth;
        $weekDays = $this->get_weekdays($dt->format('m'), $dt->format('Y'));

        return view('components.search-result-table-component', [
            'employees' => Employee::where('company_id', $this->company)->with(['salaryFormula'])->get(),
            'month' => $this->month,
            'days' => $days,
            'weekDays' => $weekDays,

        ]);
    }
}
