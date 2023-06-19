<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\EmployeeAdditionalInformation;
use App\Models\EmployeeBankDetails;
use App\Models\EmployeeEmergencyContact;
use App\Models\User;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::active()->with(['owner', 'company', 'designation'])->get();
            return DataTables::of($data)->make(true);
        }


        return view('pages.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bytes = random_bytes(5);
        return view('pages.employees.create', [
            'registration_no' => bin2hex($bytes)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $employee = Employee::firstOrCreate($request->validated());
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $employee->addMediaFromRequest('image')->toMediaCollection('avatars', 'avatars');
                }
            });
            return JsonResponseService::getJsonSuccess('Employee was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return redirect()->route('dashboard.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('pages.employees.create', [
            'employee' => $employee,
            'registration_no' => $employee->registration_no
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = array_merge($request->validated(), [
            'employee_id' => $employee->id
        ]);
        unset($data["type"]);
        if ($request->type == 'additional_information') {
            EmployeeAdditionalInformation::updateOrCreate([
                'employee_id' => $employee->id
            ], $data);
            return JsonResponseService::getJsonSuccess('Additional Information was added/updated successfully.');
        } else if ($request->type == 'bank_details') {
            EmployeeBankDetails::updateOrCreate([
                'employee_id' => $employee->id
            ], $data);
            return JsonResponseService::getJsonSuccess('Bank details were added/updated successfully.');
        } else if ($request->type == 'emergency_contact_details') {
            EmployeeEmergencyContact::updateOrCreate([
                'employee_id' => $employee->id
            ], $data);
            return JsonResponseService::getJsonSuccess('Emergency Contact(s) were added/updated successfully.');
        } else {
            unset($data['employee_id']);
            Employee::where('id', $employee->id)->exists()
                ? Employee::where('id', $employee->id)->update($data)
                : Employee::create($data);
            return JsonResponseService::getJsonSuccess('Employee was updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->delete()) {
            EmployeeBankDetails::where('employee_id', $employee->id)->delete();
            EmployeeAdditionalInformation::where('employee_id', $employee->id)->delete();
            EmployeeEmergencyContact::where('employee_id', $employee->id)->delete();
            if ($employee->user_id != NULL)
                User::where('id', $employee->user_id)->delete();

            return JsonResponseService::getJsonSuccess('Employee was deleted successfully.');
        }
        return JsonResponseService::getJsonFailed('Failed to delete employee.');
    }
}
