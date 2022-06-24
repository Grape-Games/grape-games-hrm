<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSalarySlip;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function __invoke(Request $request)
    {

        $obj = [
            "per_day" => $request->data[4][0],
            "basic_salary" => $request->data[7][0],
            "salaried_days" => $request->data[14][0],
            "half_days" => $request->data[34],
            "leaves" => $request->data[15][0],
            "days_deduction" => $request->data[18][0],
            "late_minutes" => $request->data[20][0],
            "late_minutes_deduction" => $request->data[21][0],
            "net_salary" => $request->data[27][0],
            "deduction_compensated" => $request->data[29],
            "advance" => $request->data[30],
            "loan" => $request->data[31],
            "electricity" => $request->data[32],
            "income_tax" => $request->data[33],
            "dated" => $request->date,
            "employee_id" => $request->id,
            "user_id" => auth()->id()
        ];

        $create = EmployeeSalarySlip::updateOrCreate([
            "dated" => $request->date,
            "employee_id" => $request->id
        ], $obj);

        if ($create)
            return JsonResponseService::getJsonSuccess("Salary was successfully saved.");
        return JsonResponseService::getJsonSuccess("There was a problem in saving slip, please try again.");
    }
}
