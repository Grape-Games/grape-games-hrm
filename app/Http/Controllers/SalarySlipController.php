<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalarySlipRequest;
use App\Models\SalarySlip;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalarySlipController extends Controller
{
    public function __invoke(StoreSalarySlipRequest $request)
    {
        $data = $request->validated();
        $data['month_year'] = Carbon::now()->format('Y-M');
        try {
            DB::beginTransaction();
            if ($slip = SalarySlip::updateOrCreate(
                [
                    'employee_id'    => $data['employee_id'],
                    'month_year' => $data['month_year'],
                ],
                $data
            )) {
                DB::commit();
                return JSONResponseService::getJsonSuccess(route('print-slip', ['id' => $slip->id]));
                // return JsonResponseService::getJsonSuccess('Employee Salary information is successfully updated/created.');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return JsonResponseService::getJsonException($exception);
        }
    }
}
