<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalarySlip;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeSalaryController extends Controller
{
    public function __invoke(Request $request)
    {$month =date('m', strtotime($request->monthYear));
        $monthDays = Carbon::now()->month($month)->daysInMonth;
        $per_day = $request->emp_basicSalary/$monthDays;
        $per_hour = $per_day/8;
        $per_minute = $per_hour/60;
       $obj = [
            "per_day" => $per_day,
            "per_hour" => $per_hour,
            "per_minute" => $per_minute,
            "basic_salary" => $request->emp_basicSalary,
            "totalIncrement" => $request->emp_totalIncrement,
            "total_salary" => $request->emp_totalSalary,
            "absents" => $request->absents,
            "absent_deduction" => $request->absentDeductions,
            "half_days" => $request->totalHalfDays,
            "half_day_deduction" => $request->halfDaysDeductions,
            "late_minutes" =>$request->total_lateMinutes, 
            "late_minutes_deduction" => $request->lateMinutesDeductions,
            "sandwich_rule_deduction" => $request->snadWhichRuleDeductions,
            "other_deduction" => $request->otherDeduction,
            "loan" => $request->loan,
            "bouns" => $request->bouns,
            "tax_deduction" => $request->taxDeduction, 
            "deduction_before_compensation" => $request->DeductionBeforComp,
            "compensation" => $request->compensation, 
            "deduction_after_compensation" => $request->DeductionafterComp,
            "approved_salary" => $request->totalSalaryApprove,
            "dated" => $request->monthYear,
            "employee_id" => $request->id,
            "user_id" => auth()->id()
        ];
       
         $create = EmployeeSalarySlip::updateOrCreate([
            "dated" => $request->monthYear,
            "employee_id" => $request->id
        ],$obj);
      
        if ($create)
            return JsonResponseService::getJsonSuccess("Salary was successfully saved.");
        return JsonResponseService::getJsonSuccess("There was a problem in saving slip, please try again.");
    }
}
