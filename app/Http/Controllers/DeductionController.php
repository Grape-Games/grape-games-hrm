<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Http\Requests\StoreDeductionRequest;
use App\Models\User;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          if ($request->ajax()) {
            $data = Deduction::with('employee','user')->get();
            return DataTables::of($data)
            ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
        
     
        return view("pages.deduction.index");
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
    public function store(StoreDeductionRequest $request)
    {
             try {
            if($request->filled('deduction_id')){
                   Deduction::where('id',$request->deduction_id)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Deduction was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                    Deduction::create($request->validated());  
                
            });
                    return JsonResponseService::getJsonSuccess('Deduction was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
        
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
       return response()->json($deduction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
         if ($deduction->delete())
            return JsonResponseService::getJsonSuccess('Deduction was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete Deduction');
    }
}
