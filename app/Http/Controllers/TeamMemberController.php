<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\storeTeamMember;
use Yajra\DataTables\Facades\DataTables;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use DB;
use Auth;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) { 
            $data = User::where('role','team_lead')->get();
            
            return DataTables::of($data)
            ->make(true);
        }
        
        return view('pages.team-members.index');
    }
    
    public function TeamMembers($id){
        $data =  TeamMember::with('employee','assigned_by')->where('assigned_to',$id)->get();
        // return response()->json($data);
        return [
            'data' => $data,
        ];
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
        $check = TeamMember::where(['employee_id' => $request->employee_id,'assigned_to' => $request->assigned_to])->first();
        if($check){
            return response([
                'status' => 400,
                 'message' => 'This Employee already Member of this Team.'
            ]);
        }

       $emp = TeamMember::create([
            'employee_id'=> $request->employee_id,
            'assigned_to'  => $request->assigned_to,
            'assigned_by' => Auth::user()->id
        ]);
        return response([
            'status' => 200,
            'data' => TeamMember::with('employee','assigned_by')->where('assigned_to',$request->assigned_to)->get(),
            'message' => 'Member added Successfully.'
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->delete())
        return JsonResponseService::getJsonSuccess('Record was deleted successfully.');
    return JsonResponseService::getJsonFailed('Failed to delete Record.');
    }
}
