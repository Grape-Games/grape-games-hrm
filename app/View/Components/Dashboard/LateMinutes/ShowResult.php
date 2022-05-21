<?php

namespace App\View\Components\Dashboard\LateMinutes;

use App\Models\Attendance;
use App\Models\LateMinutes;
use App\Traits\AttendanceTrait;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ShowResult extends Component
{
    use DateTrait, AttendanceTrait;
    public $employeeId, $companyId, $date, $hd;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employeeId, $companyId, $date)
    {
        $this->employeeId = $employeeId;
        $this->companyId = $companyId;
        $this->date = $date;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $parsed = Carbon::parse($this->date);
        $dates = $this->generateDateRange2(
            Carbon::parse($this->date)->startOfMonth(),
            Carbon::parse($this->date)->endOfMonth()
        );
        $data = $this->getEmployeeAttedanceByMonth($this->employeeId, $parsed->month, $this->companyId);
        return view('components.dashboard.late-minutes.show-result', [
            'data2' => $data,
            'dates' => $dates,
        ]);
    }
}
