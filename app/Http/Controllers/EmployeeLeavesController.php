<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaves;
use App\Http\Requests\StoreEmployeeLeavesRequest;
use App\Http\Requests\UpdateEmployeeLeavesRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeLeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('*')->with(['owner', 'company', 'designation']);
            return DataTables::of($data)->make(true);
        }
        return view('pages.employee-leaves.index');
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
     * @param  \App\Http\Requests\StoreEmployeeLeavesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeLeavesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeLeaves  $employeeLeaves
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeLeaves $employeeLeaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeLeaves  $employeeLeaves
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeLeaves $employeeLeaves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeLeavesRequest  $request
     * @param  \App\Models\EmployeeLeaves  $employeeLeaves
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeLeavesRequest $request, EmployeeLeaves $employeeLeaves)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeLeaves  $employeeLeaves
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeLeaves $employeeLeaves)
    {
        //
    }
}
