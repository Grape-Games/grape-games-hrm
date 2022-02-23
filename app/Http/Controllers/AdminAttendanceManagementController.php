<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Services\JsonResponseService;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAttendanceManagementController extends Controller
{
    use DateTrait;

    public function index(Request $request)
    {
        $statsArr = [];

        if ($request->filled(['employee_id', 'year', 'month'])) {
            $thisMonthDays = $this->generateDateRange(
                Carbon::parse($request->month . '-' . $request->year)->startOfMonth(),
                Carbon::parse($request->month . '-' . $request->year)->endOfMonth()
            );

            $workingDays = floor($this->getWorkingDays(
                Carbon::parse($request->month . '-' . $request->year)->startOfMonth(),
                Carbon::parse($request->month . '-' . $request->year)->endOfMonth(),
                []
            ));

            $satSuns = $this->getSatSuns(
                Carbon::parse($request->month . '-' . $request->year)->startOfMonth(),
                Carbon::parse($request->month . '-' . $request->year)->endOfMonth()
            );

            $result = Employee::where('id', $request->employee_id)->with(['company', 'attendances' => function ($q) use ($request) {
                $q->select('*', DB::table('attendances')->raw('DATE(attendance) as date'))
                    ->whereMonth('attendance', Carbon::parse($request->month . '-' . $request->year)->month)
                    ->groupBy('date', 'employee_id');
            }])->get();
        } else {

            $thisMonthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
            $workingDays = floor($this->getWorkingDays(Carbon::now()->startOfMonth(), Carbon::now(), []));
            $satSuns = $this->getSatSuns(Carbon::now()->startOfMonth(), Carbon::now());

            $result = Employee::with(['company', 'attendances' => function ($q) {
                $q->select('*', DB::table('attendances')->raw('DATE(attendance) as date'))
                    ->whereMonth('attendance', Carbon::now()->month)
                    ->groupBy('date', 'employee_id');
            }])->get();
        }
        return view('pages.admin.attendance.index', [
            'monthDays' => $thisMonthDays,
            'years' => range(1990, strftime('%Y', time())),
            'workingDays' => $workingDays,
            'result' => $result,
            'satSuns' => $satSuns,
            'employeesT' => Employee::all(),
        ]);
    }

    public function deletePunch(Request $request)
    {
        if (Attendance::where('id', $request->id)->delete()) {
            session()->flash('message', 'Successfully done the operation.');
            return JsonResponseService::getJsonSuccess('Record deleted successfully.');
        } else {
            return JsonResponseService::getJsonFailed('Failed to delete the record , please try again.');
        }
    }
}
