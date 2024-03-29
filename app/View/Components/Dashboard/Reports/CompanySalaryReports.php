<?php

namespace App\View\Components\Dashboard\Reports;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\EmployeeSalarySlip;
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

            $employees = Employee::active()
                ->enrolled()
                ->companies($this->companyId)
                ->with(['bank', 'salaryFormula', 'company', 'designation'])
                ->get();

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

                    $allowOverTime = isset($employee->company) ? $employee->company->over_time_payment : false;
                    $snadWhichRuleDates = GetSandWichRuleDate($searchDate, $employee);
                    $overTimeHours = getEmployeeOverTimeHoursByAttendances($attendances);


                    $totalDeductionsWithLoan =  $lateMinutesModule['halfDaysDeductions'] + $lateMinutesModule['lateMinutesDeductions'] + ($tempered * $absents) + GetEmployeeMonthlyLoan($employee->id, $searchDate) + (count($snadWhichRuleDates) * $tempered) + GetEmployeeDeduction($employee->id, $searchDate);

                    $sal = $employee['salaryFormula']['basic_salary'] + GetEmployeeIncrements($employee->id) + GetEmployeeBouns($employee->id, $searchDate) - $totalDeductionsWithLoan;

                    $allowOverTime
                        ? $sal += $overTimeHours * $employee->salaryFormula->per_hour
                        : '';
                    $lateMinutes = getEmployeeLateMinutesByAttendances($employee,  $attendances, $employee->salaryFormula->basic_salary);
                    $slipArr = array();



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
                        "payOvertime" => $allowOverTime,
                        "overTimeHours" => $overTimeHours,
                        "salariedDays" => $salariedDays,
                        "absents" => $absents,
                        "absentDeductions" => $tempered * $absents,

                        "calculatedSalary" => $sal,
                        "extras" => EmployeeSalarySlip::where("dated", $this->date)->where("employee_id", $employee->id)->first(),
                        'loan' => GetEmployeeMonthlyLoan($employee->id, $searchDate),
                        'bouns' => GetEmployeeBouns($employee->id, $searchDate),
                        'deduction' => GetEmployeeDeduction($employee->id, $searchDate),
                        'increment' => GetEmployeeIncrements($employee->id),

                        'totalLateMinutes' => $lateMinutes['lateMinutesTotal'],
                        'totalHalfDays' => $lateMinutes['halfDays'],
                        'halfDaysDeductions' => $lateMinutesModule['halfDaysDeductions'],
                        'snadWhichRuleDates' => count($snadWhichRuleDates),
                        'snadWhichRuleDeductions' => count($snadWhichRuleDates) * $tempered,
                        'totalDeductions' => ($tempered * $absents) + ($lateMinutesModule['halfDaysDeductions'] + $lateMinutesModule['lateMinutesDeductions'] + (count($snadWhichRuleDates) * $tempered) + GetEmployeeDeduction($employee->id, $searchDate)),
                        'empsalarySlip' => EmployeeSalarySlip::where(['dated' => $searchDate->format('Y-m'), 'employee_id' => $employee->id])->first(),

                    ]);
                } else {
                    array_push($this->result, [
                        "employee" => $employee,
                        "notValid" => true
                    ]);
                }
            }
        } else {
            $employee = Employee::where('id', $this->employeeId)->with(['bank', 'salaryFormula', 'company', 'designation'])->first();

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

                $allowOverTime = isset($employee->company) ? $employee->company->over_time_payment : false;

                $overTimeHours = getEmployeeOverTimeHoursByAttendances($attendances);
                $snadWhichRuleDates = GetSandWichRuleDate($searchDate, $employee);
                $totalDeductionsWithLoan =  $lateMinutesModule['halfDaysDeductions'] + $lateMinutesModule['lateMinutesDeductions'] + ($tempered * $absents) + GetEmployeeMonthlyLoan($employee->id, $searchDate) + (count($snadWhichRuleDates) * $tempered) + GetEmployeeDeduction($employee->id, $searchDate);

                $sal = $employee['salaryFormula']['basic_salary'] + GetEmployeeIncrements($employee->id) + GetEmployeeBouns($employee->id, $searchDate) - $totalDeductionsWithLoan;

                $allowOverTime
                    ? $sal += $overTimeHours * $employee->salaryFormula->per_hour
                    : '';

                $lateMinutes = getEmployeeLateMinutesByAttendances($employee,  $attendances, $employee->salaryFormula->basic_salary);



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
                    "payOvertime" => $allowOverTime,
                    "overTimeHours" => $overTimeHours,
                    "salariedDays" => $salariedDays,
                    "absents" => $absents,
                    "absentDeductions" => $tempered * $absents,
                    "calculatedSalary" => $sal,
                    "extras" => EmployeeSalarySlip::where("dated", $this->date)->where("employee_id", $employee->id)->first(),
                    'loan' => GetEmployeeMonthlyLoan($employee->id, $searchDate),
                    'bouns' => GetEmployeeBouns($employee->id, $searchDate),
                    'deduction' => GetEmployeeDeduction($employee->id, $searchDate),
                    'increment' => GetEmployeeIncrements($employee->id),
                    'total_salary' => $employee['salaryFormula']['basic_salary'],
                    'totalLateMinutes' => $lateMinutes['lateMinutesTotal'],
                    'totalHalfDays' => $lateMinutes['halfDays'],
                    'halfDaysDeductions' => $lateMinutesModule['halfDaysDeductions'],
                    'snadWhichRuleDates' => count($snadWhichRuleDates),
                    'snadWhichRuleDeductions' => count($snadWhichRuleDates) * $tempered,
                    'totalDeductions' => ($tempered * $absents) + ($lateMinutesModule['halfDaysDeductions'] + $lateMinutesModule['lateMinutesDeductions'] + (count($snadWhichRuleDates) * $tempered) + GetEmployeeDeduction($employee->id, $searchDate)),
                    'empsalarySlip' => EmployeeSalarySlip::where(['dated' => $searchDate->format('Y-m'), 'employee_id' => $employee->id])->first(),
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
