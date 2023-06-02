<?php

namespace App\Http\Controllers;

use App\Models\SandWichRule;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSandWichRuleRequest;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\EmployeeNotification;
use App\Models\User;
use App\Models\Employee;


class SandWichRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SandWichRule::with('user')->get();
            return DataTables::of($data)
            ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
       return view('pages.sandwich.index');
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
    public function store(StoreSandWichRuleRequest $request)
    {
        
         try {

      

            // $users = Employee::get();
           
            // echo User::all();
            if($request->filled('sandwich_id')){
                   SandWichRule::where('id',$request->sandwich_id)->update($request->validated());
                    return JsonResponseService::getJsonSuccess('Sand which Rule was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                    SandWichRule::create($request->validated());  
                  
                
            });
            $users = User::get();
            $db['heading'] = 'Set Sand Wich Rule Date';
            $db['avatar'] =  '/assets/img/new-user.png';
            $db['redirect'] = route('dashboard.increment.index');
            $db['details'] = " Sand Wich Rule Set on ".$request->date;
          
           
            $delay = now()->addMinutes(1);
           foreach($users as $user){
               $user->notify((new EmployeeNotification($db))); 
           }
                    return JsonResponseService::getJsonSuccess('Sand which Rule was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SandWhichRule  $sandWhichRule
     * @return \Illuminate\Http\Response
     */
    public function show(SandWichRule $sandWhichRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SandWhichRule  $sandWhichRule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SandWichRule::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SandWhichRule  $sandWhichRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SandWichRule $sandWhichRule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SandWhichRule  $sandWhichRule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SandWichRule::findOrFail($id);
        if ($data->delete())
            return JsonResponseService::getJsonSuccess('Sand Which Rule was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete  Which Rule');
    }
}
