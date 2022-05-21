<?php

namespace App\View\Components\Dashboard\Reports;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\SalarySlip;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\View\Component;

class CompanySalaryReports extends Component
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
        $this->date = $date;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $searchDate = Carbon::parse($this->date);

        $dates = $this->generateDateRange2(
            Carbon::parse($this->date)->startOfMonth(),
            Carbon::parse($this->date)->endOfMonth()
        );

        $satSuns = $this->getSatSuns(
            Carbon::parse($this->date)->startOfMonth(),
            Carbon::parse($this->date)->endOfMonth()
        );

        $this->result = [];

        if ($this->employeeId == "all") {

            $employees = Employee::companies($this->companyId)->with(['bank', 'salaryFormula', 'company', 'designation'])->get();

            foreach ($employees as $key => $employee) {

                $tempered = $employee->salaryFormula->basic_salary / count($dates);

                $attendances = Attendance::where('employee_id', $employee->id)
                    ->whereMonth('attendance', $searchDate->month)
                    ->whereYear('attendance', $searchDate->year)
                    ->with(['employee.designation:id,name'])->get()->groupBy(function ($date) {
                        return Carbon::parse($date->attendance)->format('Y-m-d');
                    });

                foreach ($attendances as $key => $day) {
                    $date = Carbon::parse($key);
                    if ($date->dayOfWeek == Carbon::SATURDAY || $date->dayOfWeek == Carbon::SUNDAY)
                        unset($attendances[$key]);
                }

                $leaves = EmployeeLeaves::leavesMonthly($employee->user_id, $searchDate, 'approved')->sum('number_of_leaves');
                $absents = count($dates) - count($attendances) - ($satSuns['sundays'] + $satSuns['saturdays']) - $leaves;
                $deductions = $tempered * $absents;

                array_push($this->result, [
                    'employee' => $employee,
                    'tempered' => $tempered,
                    'presents' => count($attendances),
                    'absents' => $absents,
                    'approved_leaves' => $leaves,
                    'att' => count($attendances),
                    'salaried_days' => count($attendances) + $leaves + $satSuns['sundays'] + $satSuns['saturdays'],
                    'deductions' => $deductions,
                    'net_salary' => $employee->salaryFormula->basic_salary - $deductions,
                    'sat_suns' => $satSuns['sundays'] + $satSuns['saturdays'],
                    'additional' => SalarySlip::where('employee_id', $employee->id)->latest()->first(),
                ]);
            }
        } else {

            // $data = Employee::whereId($this->employeeId)->with(['bank', 'salaryFormula'])->get();

            dd('solo');
        }

        return view('components.dashboard.reports.company-salary-reports', [
            'satSuns' => $satSuns,
            'dates' => $dates
        ]);
    }
}
