<?php

namespace App\Http\Controllers;

use App\Models\EmployeeBonus;
use App\Http\Requests\StoreEmployeeBonusRequest;
use App\Models\User;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {     
        if ($request->ajax()) {
            $data  = EmployeeBonus::with('employee','user')->get();
            return DataTables::of($data)
             ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
        return view('pages.employee-bonus.index');
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
    public function store(StoreEmployeeBonusRequest $request)
    {
       
        try {
            if($request->filled('bonus_id')){
                   EmployeeBonus::where('id',$request->bonus_id)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Employee Bonus was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                    EmployeeBonus::create($request->validated());  
                
            });
                    return JsonResponseService::getJsonSuccess('Employee Bonus was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EmployeeBonus::where('id',$id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
         if (EmployeeBonus::where('id', $id)->delete()) {
             return JsonResponseService::getJsonSuccess('Employee Bonus  deleted successfully.');
        }
        return JsonResponseService::getJsonFailed('Failed to delete Employee Bonus.');
    }
}
