<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = task::with('user','employee','project')->get();
            return DataTables::of($data)
            ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
       return view('pages.task.index');
    }

 
    public function taskStatusChange(Request $request){
        task::where('id',$request->id)->update(['status' => $request->status]);
        return JsonResponseService::getJsonSuccess("Task Status was updated successfully.");
    }

    public function taskDetails($id){
       
        return view('pages.task.task_details');

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
    public function store(StoreTaskRequest $request)
    {
        try {
            if($request->filled('task_id')){
                task::where('id',$request->iii)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Task was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                        task::create($request->validated());  
            });
                    return JsonResponseService::getJsonSuccess('Task was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        return response($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        if ($task->delete())
            return JsonResponseService::getJsonSuccess('Task was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete Task.');
    }
}
