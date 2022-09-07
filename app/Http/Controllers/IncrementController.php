<?php

namespace App\Http\Controllers;

use App\Models\Increment;
use App\Models\SalaryFormula; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreIncrementRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use DB;

class IncrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EmployeeAllIncrements($employee_id){
       $inc = SalaryFormula::where('employee_id',$employee_id)->first();
       $emp_in = Increment::where('employee_id',$employee_id)->get();
       
       if(!is_null($inc->increment_due)){
           return response()->json(
             ['all_inc' => $emp_in,
               'next_Increment' => Carbon::createFromFormat('Y-m-d H:i:s', $inc->increment_due)->format('d-m-Y'),
             ]
               );
        }else{
        return response()->json([
            'all_inc' => $emp_in,
            'next_Increment' => 'empty'

        ]);
      
        }
      
      
    }
    public function index(Request $request)
    { 
          if ($request->ajax()) {
            $data  = Increment::with('employee','user')->get();
            return DataTables::of($data)
             ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
        return view('pages.increment.index');
    }


    public function employeeLastIncrement($employee_id){
        $data = Increment::select('amount','month')->where('employee_id',$employee_id)->get()->last();
        $salry = SalaryFormula::where('employee_id',$employee_id)->first();
        if($salry){
            return response()->json(['last_increment'=>$data,'salry'=>$salry]);
        }else{
            return JsonResponseService::getJsonException("last increment Not avliable.");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncrementRequest $request)
    {
        try {
            if($request->filled('increment_id')){
                   Increment::where('id',$request->increment_id)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Increment was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                    Increment::create($request->validated());  
                
            });
                    return JsonResponseService::getJsonSuccess('Increment was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function show(Increment $increment)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function edit(Increment $increment)
    {
        return response()->json($increment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Increment $increment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Increment  $increment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Increment $increment)
    {
         if ($increment->delete())
            return JsonResponseService::getJsonSuccess('Increment was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete Increment');
    }
}
