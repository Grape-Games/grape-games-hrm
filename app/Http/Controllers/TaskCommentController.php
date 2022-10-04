<?php

namespace App\Http\Controllers;

use App\Models\TaskComment;
use Illuminate\Http\Request;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Auth;
use Exception;
use DB;

class TaskCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        TaskComment::insert([
            'comment' => $request->comment,
            'task_id' => $request->task_id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        return JsonResponseService::getJsonSuccess('Comment was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function show(TaskComment $taskComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskComment $taskComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskComment $taskComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskComment  $taskComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskComment $taskComment)
    {
        if ($taskComment->delete())
        return JsonResponseService::getJsonSuccess('Comment was deleted successfully.');
    return JsonResponseService::getJsonFailed('Failed to delete Comment.');
    }
}
