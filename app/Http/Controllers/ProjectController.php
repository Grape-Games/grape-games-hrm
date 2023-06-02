<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = project::with('user')->get();
            return DataTables::of($data)
            ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
        return view('pages.project.index');
    }


    function projectStatusChange(Request $request){
      $result =  project::where('id',$request->id)->update(['status' => $request->status]);
        return JsonResponseService::getJsonSuccess("Project Status was updated successfully.");
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
    public function store(StoreProjectRequest $request)
    {
        try {
            if($request->filled('project_id')){
                project::where('id',$request->project_id)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Project was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                    $request->status = 1;
                    project::create($request->validated());  
            });
                    return JsonResponseService::getJsonSuccess('Project was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        return response($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        if ($project->delete())
            return JsonResponseService::getJsonSuccess('Project was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete Project.');
    }
}
