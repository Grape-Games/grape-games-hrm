<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employees\Profile\UpdatePasswordRequest;
use App\Http\Requests\StoreEmployeeHrmAccountRequest;
use App\Models\Employee;
use App\Models\User;
use App\Services\JsonResponseService;
use App\Services\MailService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeAccountCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)->make(true);
        }

        return view('pages.employees.accounts.index');
    }
    
    public function EmployeeCompany($id){
         $data = Employee::where('id',$id)->with('company')->first();
         return ['data' => $data, 'status' => 'Data fetching Successful'];
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
    public function store(StoreEmployeeHrmAccountRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = User::create($request->validated());
                Employee::where('id', $request->employee_id)->update(['user_id' => $user->id]);
                MailService::sendEmailWithCredentials($request->email, $request->password, $user);
                MailService::sendEmailToAdmin($request->email, $request->password, $user);
            });
            return JsonResponseService::getJsonSuccess('Employee account was created successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return ($id);
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $user->clearMediaCollection('avatars');
                $user->addMediaFromRequest('file')->toMediaCollection('avatars', 'avatars');
            }
            if ($user->update($request->validated()))
                return JsonResponseService::getJsonSuccess('Profile updated successfully.');
            return JsonResponseService::getJsonFailed('Failed to update the profile.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->role != 'admin') {
            if (Employee::where('user_id', $id)->update(['user_id' => NULL]))
                if (User::find($id)->delete())
                    return JsonResponseService::getJsonSuccess('Employee account was deleted successfully.');
        }

        return JsonResponseService::getJsonFailed('Failed to delete employee account.');
    }
}
