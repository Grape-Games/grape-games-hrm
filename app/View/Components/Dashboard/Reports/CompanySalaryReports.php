<?php

namespace App\View\Components\Dashboard\Reports;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\Holiday;
use App\Models\SalarySlip;
use App\Models\WorkingDay;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\View\Component;

use function PHPUnit\Framework\isEmpty;

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

                if (isset($employee->salaryFormula)) {
                    $tempered = $employee->salaryFormula->basic_salary / count($dates); // making per day accorking to number of days

                    $attendances = employeeAttendances($employee, $searchDate);

                    $workingDays = WorkingDay::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->pluck('date')->toArray();

                    $holidays = Holiday::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->pluck('date')->toArray();

                    $leaves = EmployeeLeaves::leavesMonthly($employee->user_id, $searchDate, 'approved')->sum('number_of_leaves');

                    $presentDays = count($attendances);

                    $weekendDays = $satSuns['saturdays'] + $satSuns['sundays'];

                    $additionalDays = count($workingDays);

                    $salariedDays =  $presentDays + count($holidays) + $leaves + $weekendDays - $additionalDays;

                    $absents = count($dates) - $salariedDays;

                    $lateMinutesModule = getEmployeeLateMinutesByAttendances($employee, $attendances, $tempered);


                    array_push($this->result, [
                        "tempered" => $tempered,
                        "employee" => $employee,
                        "additional" => SalarySlip::where('employee_id', $employee->id)->latest()->first(),
                        "days" => count($dates),
                        "weekends" => $satSuns,
                        "weekendCounts" => $satSuns['saturdays'] + $satSuns['sundays'],
                        "additionalDays" => $workingDays,
                        "additionalDaysCount" => count($workingDays),
                        "attendances" => count($attendances),
                        "holidays" => $holidays,
                        "leaves" => $leaves,
                        "lateMinutesModule" => $lateMinutesModule,
                        "salariedDays" => $salariedDays,
                        "absents" => $absents,
                        "absentDeductions" => $tempered * $absents,
                        "calculatedSalary" => ($salariedDays * $tempered) - $lateMinutesModule['halfDaysDeductions'] - $lateMinutesModule['lateMinutesDeductions'],
                    ]);
                } else {
                    array_push($this->result, [
                        "employee" => $employee,
                        "notValid" => true
                    ]);
                }
            }
        } else {
            $employee = Employee::where('id',$this->employeeId)->with(['bank', 'salaryFormula', 'company', 'designation'])->first();

            if (isset($employee->salaryFormula)) {
                $tempered = $employee->salaryFormula->basic_salary / count($dates); // making per day accorking to number of days

                $attendances = employeeAttendances($employee, $searchDate);

                $workingDays = WorkingDay::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->pluck('date')->toArray();

                $holidays = Holiday::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->pluck('date')->toArray();

                $leaves = EmployeeLeaves::leavesMonthly($employee->user_id, $searchDate, 'approved')->sum('number_of_leaves');

                $presentDays = count($attendances);

                $weekendDays = $satSuns['saturdays'] + $satSuns['sundays'];

                $additionalDays = count($workingDays);

                $salariedDays =  $presentDays + count($holidays) + $leaves + $weekendDays - $additionalDays;

                $absents = count($dates) - $salariedDays;

                $lateMinutesModule = getEmployeeLateMinutesByAttendances($employee, $attendances, $tempered);


                array_push($this->result, [
                    "tempered" => $tempered,
                    "employee" => $employee,
                    "additional" => SalarySlip::where('employee_id', $employee->id)->latest()->first(),
                    "days" => count($dates),
                    "weekends" => $satSuns,
                    "weekendCounts" => $satSuns['saturdays'] + $satSuns['sundays'],
                    "additionalDays" => $workingDays,
                    "additionalDaysCount" => count($workingDays),
                    "attendances" => count($attendances),
                    "holidays" => $holidays,
                    "leaves" => $leaves,
                    "lateMinutesModule" => $lateMinutesModule,
                    "salariedDays" => $salariedDays,
                    "absents" => $absents,
                    "absentDeductions" => $tempered * $absents,
                    "calculatedSalary" => ($salariedDays * $tempered) - $lateMinutesModule['halfDaysDeductions'] - $lateMinutesModule['lateMinutesDeductions'],
                ]);
            } else {
                array_push($this->result, [
                    "employee" => $employee,
                    "notValid" => true
                ]);
            }
        }

        return view('components.dashboard.reports.company-salary-reports', [
            'satSuns' => $satSuns,
            'dates' => $dates
        ]);
    }
}
