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
            $employeeArrays = [];
            $thisMonthDays = $this->generateDateRange(
                Carbon::parse($request->month . '-' . $request->year)->startOfMonth(),
                Carbon::parse($request->month . '-' . $request->year)->endOfMonth()
            );
            array_push(
                $employeeArrays,
                Attendance::where('employee_id', $request->employee_id)
                    ->whereMonth('attendance', Carbon::parse($request->month . '-' . $request->year)->month)
                    ->whereYear('attendance', $request->year)
                    ->with(['employee'])->get()
                    ->groupBy(function ($date) {
                        return Carbon::parse($date->attendance)->format('Y-m-d');
                    })
            );
            $thisMonthDaysPresence = Attendance::where('employee_id', $request->employee_id)
                ->whereMonth('created_at', Carbon::now()->month)->get()->groupBy(function ($date) {
                    return Carbon::parse($date->attendance)->format('Y-m-d');
                });
            array_push($statsArr, [
                'employee_id' => $request->employee_id,
                'presenceArr' => $thisMonthDaysPresence
            ]);
        } else {

            $thisMonthDays = $this->generateDateRange(Carbon::now()->startOfMonth(), Carbon::now());
            $workingDays = floor($this->getWorkingDays(Carbon::now()->startOfMonth(), Carbon::now(), []));
            $satSuns = $this->getSatSuns(Carbon::now()->startOfMonth(), Carbon::now());

            $result = Employee::with(['company', 'attendances' => function ($q) {
                $q->select('*', DB::table('attendances')->raw('DATE(attendance) as date'))
                    ->whereMonth('attendance', Carbon::now()->month)
                    ->groupBy('date', 'employee_id');
            }])->get();
            // $employeeId = Employee::with(['attendances' => function ($q) use ($request) {
            //     $q->whereMonth('attendance', Carbon::now()->month)
            //         ->groupBy(function ($date) {
            //             return Carbon::parse($date->attendance)->format('Y-m-d');
            //         });
            // }])->get()->toArray();
            // dd($employeeId);
            // foreach ($employeeId as $key => $value) {
            //     array_push(
            //         $employeeArrays,
            //         Attendance::where('employee_id', $value)
            //             ->whereMonth('attendance', Carbon::now()->month)
            //             ->with(['employee'])->get()
            //             ->groupBy(function ($date) {
            //                 return Carbon::parse($date->attendance)->format('Y-m-d');
            //             })
            //     );
            //     $thisMonthDaysPresence = Attendance::where('employee_id', $value)
            //         ->whereMonth('created_at', Carbon::now()->month)->get()->groupBy(function ($date) {
            //             return Carbon::parse($date->attendance)->format('Y-m-d');
            //         });
            //     array_push($statsArr, [
            //         'employee_id' => $value,
            //         'presenceArr' => $thisMonthDaysPresence
            //     ]);
            // }
        }
        return view('pages.admin.attendance.index', [
            'monthDays' => $thisMonthDays,
            'years' => range(1990, strftime('%Y', time())),
            'workingDays' => $workingDays,
            'result' => $result,
            'satSuns' => $satSuns
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
