<?php

namespace App\Http\Controllers;
use App\Http\Requests\SearchEvaluationRequest;
use App\Models\Employee;
use App\Models\Evalutation;
use App\Services\JsonResponseService;
use Carbon\Carbon;

use Illuminate\Http\Request;

class EmployeeEvaluationController extends Controller
{
    public function index(){
        return view('pages.employee-evaluation.index');
    }


    public function employeeEvaluationReport(SearchEvaluationRequest $request){
        $employeeId = Employee::where('user_id', auth()->id())->value('id');
        $data = Evalutation::where(
            ['employee_id' => $employeeId,'month' => $request->month,'status' => 1], 
        )->first(); 
        if (!empty($data)) {
             
             return JsonResponseService::getJsonSuccess(url('/dashboard/generate-evaluation/'.$data->id));
        }
        
        return JsonResponseService::getJsonFailed('Record Not Found.'); 
    }
}
