<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaves;
use App\Http\Requests\StoreEmployeeLeavesRequest;
use App\Http\Requests\UpdateEmployeeLeavesRequest;
use App\Models\Employee;
use App\Services\JsonResponseService;
use App\Services\MailService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $data = EmployeeLeaves::with(['owner', 'approvedBy', 'type'])->get();
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
        try {
            $request->filled('leave_id')
                ? $data = array_merge($request->validated(), [
                    'approved_by' => auth()->id()
                ])
                : $data = $request->validated();
            DB::transaction(function () use ($request, $data) {
                EmployeeLeaves::updateOrCreate([
                    'id' => $request->leave_id,
                ], $data);
                $request->filled('leave_id')
                    ? ''
                    : MailService::sendGeneralEmail($request->number_of_leaves, $request->leave_type_id, $request->description);
            });
            return JsonResponseService::getJsonSuccess('Employee Leave was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
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
        if ($employeeLeaves->status == 'approved')
            return JsonResponseService::getJsonSuccess('Cannot delete availed leave.');

        if ($employeeLeaves->delete())
            return JsonResponseService::getJsonSuccess('Employee was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete designation.');
    }
}