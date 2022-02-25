<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;

class GlobalDataProvider extends Controller
{
    public function getCompanyEmployees(Request $request)
    {
        return JSONResponseService::getJsonSuccess(Employee::where('company_id', $request->id)->get());
    }
}
