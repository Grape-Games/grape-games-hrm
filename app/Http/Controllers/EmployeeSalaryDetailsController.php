<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchSalarySlipRequest;
use App\Models\Employee;
use App\Models\SalarySlip;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeSalaryDetailsController extends Controller
{
    public function reportIndex()
    {
        return view('pages.employee-salary.report');
    }

    public function index()
    {
        return view('pages.employee-salary.index');
    }
    public function printSalarySlip(SearchSalarySlipRequest $request)
    {
        $employeeId = Employee::where('user_id', auth()->id())->value('id');
        $slip = SalarySlip::where('month_year', Carbon::parse($request->month)->format('Y-M'))
            ->where('employee_id', $employeeId)->first();
        if (!empty($slip)) {
            return JsonResponseService::getJsonSuccess(route('dashboard.print-slip', [$slip->id]));
        }
        return JsonResponseService::getJsonFailed('Salary Slip is not yeat available, please contact admin.');
    }
}
