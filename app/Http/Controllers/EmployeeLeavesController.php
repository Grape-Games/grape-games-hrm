<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaves;
use App\Http\Requests\StoreEmployeeLeavesRequest;
use App\Http\Requests\UpdateEmployeeLeavesRequest;
use App\Models\Employee;
use App\Services\JsonResponseService;
use App\Services\MailService;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeLeavesController extends Controller
{
    use DateTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            auth()->user()->role == 'admin'
                ? $data = EmployeeLeaves::with(['owner', 'approvedBy', 'type'])->get()
                : $data = EmployeeLeaves::where('owner_id', auth()->id())->with(['owner', 'approvedBy', 'type'])->get();
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
            DB::transaction(function () use ($request) {
                if ($request->filled('leave_id')) {
                    $data = array_merge($request->validated(), [
                        'approved_by' => auth()->id(),
                        'number_of_leaves' => count($this->generateDateRange(Carbon::parse($request->from_date), Carbon::parse($request->to_date)))
                    ]);
                    unset($data["owner_id"]);
                    MailService::sendLeaveStatusEmailToEmployee($request->leave_id, $request->status, $request->remarks);
                    MailService::sendLeaveStatusEmailToAdmin($request->leave_id, $request->status, $request->remarks);
                } else {
                    MailService::sendLeaveEmailToEmployee($request->number_of_leaves, $request->leave_type_id, $request->description);
                    MailService::sendLeaveEmailToAdmin($request->number_of_leaves, $request->leave_type_id, $request->description);
                    $data = $request->validated();

                    $data = array_merge($request->validated(), [
                        'to_date' => Carbon::parse($request->from_date)->addDays($request->number_of_leaves)->format('Y-m-d')
                    ]);
                    if ($request->filled('employee_id')) {
                        $data['owner_id'] = $request->employee_id;
                    }
                }
                EmployeeLeaves::updateOrCreate([
                    'id' => $request->leave_id,
                ], $data);
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
    public function destroy($id)
    {
        $model = EmployeeLeaves::findOrFail($id);

        if ($model->status == 'approved')
            return JsonResponseService::getJsonFailed('Cannot delete availed leave.');

        if ($model->forceDelete())
            return JsonResponseService::getJsonSuccess('Employee leave was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete designation.');
    }
}
