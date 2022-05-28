<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\Holiday;
use App\Models\WorkingDay;
use App\Services\JsonResponseService;
use App\Traits\DateTrait;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class GlobalDataProvider extends Controller
{
    use DateTrait;

    public function getCompanyEmployees(Request $request)
    {
        return JSONResponseService::getJsonSuccess(Employee::where('company_id', $request->id)->get());
    }

    public function getEmployeePresentDays(Request $request)
    {
        $searchDate = Carbon::parse($request->date);

        $employee = Employee::where('id', $request->employeeId)->first();

        $holidays = Holiday::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->get();

        $leaves = EmployeeLeaves::leavesMonthly($employee->user_id, $searchDate, 'approved');

        $workingDays = WorkingDay::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->get();


        return JSONResponseService::getJsonSuccess(
            [
                "presents" => employeeAttendances(
                    $employee,
                    $searchDate
                ),
                "holidays" => $holidays,
                "leaves" => $leaves,
                "additional" => $workingDays
            ]
        );
    }

    public function getEmployeeAbsentDays(Request $request)
    {
        $searchDate = Carbon::parse($request->date);

        $employee = Employee::where('id', $request->employeeId)->first();

        $dates = $this->generateDateRange2(
            Carbon::parse($request->date)->startOfMonth(),
            Carbon::parse($request->date)->endOfMonth(),
            "Y-m-d"
        );

        $attendances = employeeAttendances(
            $employee,
            $searchDate
        );

        $arr = $attendances->toArray();

        foreach ($arr as $key => $value) {
            if (($key = array_search($key, $dates)) !== false)
                unset($dates[$key]);
        }
        foreach ($dates as $key => $date) {
            # code...
            $parsed = Carbon::parse($date);

            if ($parsed->dayOfWeek == Carbon::SUNDAY || $parsed->dayOfWeek == Carbon::SATURDAY) {
                unset($dates[$key]);
            }
        }

        $holidays = Holiday::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->get();

        $holidaysArr = $holidays->pluck('custom_date_second')->toArray();

        foreach ($holidaysArr as $key => $value) {
            # code...
            if (($value = array_search($value, $dates)) !== false)
                unset($dates[$value]);
        }

        $leaves = EmployeeLeaves::leavesMonthly($employee->user_id, $searchDate, 'approved');

        $leavesArray = [];

        foreach ($leaves as $key => $leave) {
            array_push($leavesArray, $this->generateDateRange(Carbon::parse($leave->from_date), Carbon::parse($leave->to_date)));
        }

        foreach ($leavesArray as $key => $day) {
            foreach ($day as $key => $sub) {

                if (($sub = array_search($sub, $dates)) !== false)
                    unset($dates[$sub]);
            }
        }

        $workingDays = WorkingDay::whereYear('date', $searchDate->year)->whereMonth('date', $searchDate->month)->pluck('date')->toArray();

        foreach ($workingDays as $key => $day) {

            if (!array_key_exists($day, $attendances->toArray())) {
                if (!in_array($day, $dates))
                    array_push($dates, $day);
            }
        }

        return JSONResponseService::getJsonSuccess($dates);
    }

    public function getEmployeeLeavesApproved(Request $request)
    {
        $searchDate = Carbon::parse($request->date);

        $employee = Employee::where('id', $request->employeeId)->first();

        $leaves = EmployeeLeaves::leavesMonthly($employee->user_id, $searchDate, 'approved');

        $leavesArray = [];

        foreach ($leaves as $key => $leave) {
            array_push($leavesArray, $this->generateDateRange(Carbon::parse($leave->from_date), Carbon::parse($leave->to_date)));
        }

        return JSONResponseService::getJsonSuccess($leavesArray);
    }

    public function getEmployeeLateMinutes(Request $request)
    {
        $searchDate = Carbon::parse($request->date);

        $employee = Employee::where('id', $request->employeeId)->first();

        $dates = $this->generateDateRange2(
            Carbon::parse($request->date)->startOfMonth(),
            Carbon::parse($request->date)->endOfMonth(),
        );

        $attendances = employeeAttendances(
            $employee,
            $searchDate
        );

        $tempered = $employee->salaryFormula->basic_salary / count($dates);

        $lateMinutesModule = getEmployeeLateMinutesByAttendances($employee, $attendances, $tempered);

        return JSONResponseService::getJsonSuccess($lateMinutesModule);
    }
}
