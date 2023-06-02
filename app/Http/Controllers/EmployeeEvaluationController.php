<?php

namespace App\Http\Controllers;
use App\Http\Requests\SearchEvaluationRequest;
use App\Models\Employee;
use App\Models\Evalutation;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class EmployeeEvaluationController extends Controller
{
    public function index(){
       
       $emp_id = Employee::where('user_id',auth()->id())->first();
       $evaluations = Evalutation::where(['employee_id' => $emp_id->id , 'status' => 1])->paginate(10);
        return view('pages.employee-evaluation.index',compact('evaluations'));
    }


   

    public function employeeLastEvaluation($id){
       $evaluation = Evalutation::where('employee_id',$id)->latest()->first();
        return[
             'employee'   => Employee::where('id',$id)->first(),
             'evaluation' => $evaluation->from_date ?? NULL,
        ];
    }
}
