<?php

namespace App\Http\Controllers;

use App\Models\DepartmentType;
use App\Http\Requests\StoreDepartmentTypeRequest;
use App\Http\Requests\UpdateDepartmentTypeRequest;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DepartmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DepartmentType::select('*')->with('owner');
            return DataTables::of($data)->make(true);
        }
        return view('pages.department-types.index');
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
     * @param  \App\Http\Requests\StoreDepartmentTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentTypeRequest $request)
    {   
        try {
            DB::transaction(function () use ($request) {
                DepartmentType::create($request->validated());
            });
            return JsonResponseService::getJsonSuccess('Department Type was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentType $departmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentType $departmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentTypeRequest  $request
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentTypeRequest $request, DepartmentType $departmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentType  $departmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentType $departmentType)
    {
        if ($departmentType->delete())
            return JsonResponseService::getJsonSuccess('Department Type was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete department type');
    }
}
