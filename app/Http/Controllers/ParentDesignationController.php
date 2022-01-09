<?php

namespace App\Http\Controllers;

use App\Models\ParentDesignation;
use App\Http\Requests\StoreParentDesignationRequest;
use App\Http\Requests\UpdateParentDesignationRequest;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ParentDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ParentDesignation::select('*')->with('owner');
            return DataTables::of($data)->make(true);
        }
        return view('pages.parent-designations.index');
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
     * @param  \App\Http\Requests\StoreParentDesignationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParentDesignationRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                ParentDesignation::create($request->validated());
            });
            return JsonResponseService::getJsonSuccess('Parent Designation was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParentDesignation  $parentDesignation
     * @return \Illuminate\Http\Response
     */
    public function show(ParentDesignation $parentDesignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParentDesignation  $parentDesignation
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentDesignation $parentDesignation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParentDesignationRequest  $request
     * @param  \App\Models\ParentDesignation  $parentDesignation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParentDesignationRequest $request, ParentDesignation $parentDesignation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParentDesignation  $parentDesignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentDesignation $parentDesignation)
    {
        if ($parentDesignation->delete())
            return JsonResponseService::getJsonSuccess('Parent Designation was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete parent designation.');
    }
}
