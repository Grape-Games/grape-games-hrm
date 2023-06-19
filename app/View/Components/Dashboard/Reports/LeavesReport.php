<?php

namespace App\View\Components\Dashboard\Reports;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\LeaveType;
use App\Models\SalarySlip;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\View\Component;

class LeavesReport extends Component
{
    use DateTrait;

    public $employeeId, $companyId, $date, $result;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employeeId, $companyId, $date)
    {
        $this->employeeId = $employeeId;
        $this->companyId = $companyId;
        $this->date = Carbon::parse($date);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->result = [];

        $satSuns = $this->getSatSuns(
            Carbon::parse($this->date)->startOfMonth(),
            Carbon::parse($this->date)->endOfMonth()
        );

        if ($this->employeeId == "all") {

            $employees = Employee::active()
                ->companies($this->companyId)
                ->with(['bank', 'salaryFormula', 'company', 'designation'])
                ->get();

            $data = [];
            foreach ($employees as $key => $employee) {
                // dd($data['leaves_approved'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'approved'));
                $data['employee'] = $employee;
                $data['leaves_allowed'] = LeaveType::sum('allowed');
                $data['leaves_left'] = $data['leaves_allowed'] - EmployeeLeaves::leavesYearly($employee->user_id, $this->date, 'approved')->sum('number_of_leaves');
                $data['leaves_taken'] = EmployeeLeaves::leavesYearly($employee->user_id, $this->date, 'approved');
                $data['leaves_approved'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'approved');
                $data['leaves_pending'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'pending');
                $data['leaves_rejected'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'rejected');
                array_push($this->result, $data);
            }
        } else {

            $employee = Employee::whereId($this->employeeId)->with(['bank', 'salaryFormula'])->first();

            $data['employee'] = $employee;
            $data['leaves_allowed'] = LeaveType::sum('allowed');
            $data['leaves_left'] = $data['leaves_allowed'] - EmployeeLeaves::leavesYearly($employee->user_id, $this->date, 'approved')->sum('number_of_leaves');
            $data['leaves_taken'] = EmployeeLeaves::leavesYearly($employee->user_id, $this->date, 'approved');
            $data['leaves_approved'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'approved');
            $data['leaves_pending'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'pending');
            $data['leaves_rejected'] = EmployeeLeaves::leavesMonthly($employee->user_id, $this->date, 'rejected');
            array_push($this->result, $data);
        }
        return view('components.dashboard.reports.leaves-report', [
            'satSuns' => $satSuns
        ]);
    }
}
