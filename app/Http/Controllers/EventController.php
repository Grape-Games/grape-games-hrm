<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\EmployeeAdditionalInformation;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()    
    {
        return view('pages.events.index', [
            'events' => Event::all(),
            'birthdays' => EmployeeAdditionalInformation::select('dob', 'employee_id')
                ->with(['employee' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                }])->get(),
        ]);
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
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Event::create($request->validated());
            });
            return JsonResponseService::getJsonSuccess('Event was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function create2(Request $request)
    {
        if (Event::create([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'category' => $request->category,
            'owner_id' => auth()->id()
        ]))
            return JsonResponseService::getJsonSuccess('Event was added successfully.');
        return JsonResponseService::getJsonFailed('Failed to add event.');
    }

    public function delete2(Request $request)
    {
        if (Event::where('id', $request->id)->delete())
            return JsonResponseService::getJsonSuccess('Event was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete event. You cannot remove employee date of births.');
    }

    public function update2(Request $request)
    {
        if (Event::where('id', $request->id)->update([
            'name' => $request->name
        ]))
            return JsonResponseService::getJsonSuccess('Event was updated successfully.');
        return JsonResponseService::getJsonFailed('Failed to updated event.');
    }
}
