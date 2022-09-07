<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEvaluationRequest;
use App\Models\Evalutation;
use Yajra\DataTables\Facades\DataTables;
use App\Services\JsonResponseService;
use Exception;
use DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax()) { 
             $data  = Evalutation::with(['employee','user'])->get();
            return DataTables::of($data)
             
            ->make(true);
        }
        
        return view('pages.evaluations.index');
       
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
    public function store(StoreEvaluationRequest $request)
    {
        try {
            if($request->filled('evaluation_id')){
                   Evalutation::where('id',$request->evaluation_id)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Evalutation was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                    Evalutation::create($request->validated());  
                
            });
                    return JsonResponseService::getJsonSuccess('Evalutation was added successfully.');
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
       return Evalutation::where('id',$id)->first();
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
    {    $delete = Evalutation::where('id',$id)->delete();
        if ($delete)
            return JsonResponseService::getJsonSuccess('Evaluation was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete Evaluation');
    }
}
