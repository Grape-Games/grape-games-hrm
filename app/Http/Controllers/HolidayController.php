<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SandWichRule;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $data = Holiday::with('owner','sandwich')->get();
            
            return DataTables::of($data)
            ->addColumn('sandwhichRules', function ($data){
                  if($data->sandwich){
                    return $data->sandwich->date;
                  }else{
                    return 'Not Applay ';
                  }
              })
            ->make(true);
        }
        return view('pages.holidays.index');
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
     * @param  \App\Http\Requests\StoreHolidayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHolidayRequest $request)
    {
        try {

            if($request->filled('hd_id')){
                DB::transaction(function () use ($request) {
                    Holiday::where('id',$request->hd_id)->update($request->validated());
                });
                return JsonResponseService::getJsonSuccess('Holiday was updated successfully.');
            }else{
                DB::transaction(function () use ($request) {
                    Holiday::create($request->validated());
                });
                return JsonResponseService::getJsonSuccess('Holiday was added successfully.');
            }
            
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return response($holiday);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHolidayRequest  $request
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        if ($holiday->delete())
            return JsonResponseService::getJsonSuccess('Holiday was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete holiday');
    }
}
