<?php

namespace App\View\Components\Dashboard\LateMinutes;

use App\Models\Attendance;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\View\Component;

class ShowResult extends Component
{
    use DateTrait;
    public $employeeId, $companyId, $month;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employeeId, $companyId, $month)
    {
        $this->employeeId = $employeeId;
        $this->companyId = $companyId;
        $this->month = $month;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $dates = $this->generateDateRange(
            Carbon::parse($this->month . '-' . $this->year)->startOfMonth(),
            Carbon::parse($this->month . '-' . $this->year)->endOfMonth()
        );
        dd($dates);
        dd(Attendance::where('employee_id', $this->employeeId)->whereMonth('attendance', $this->month)->get());
        return view('components.dashboard.late-minutes.show-result');
    }
}
