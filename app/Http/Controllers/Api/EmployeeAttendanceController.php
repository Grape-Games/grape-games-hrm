<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function save(Request $request)
    {
        // if(!is_null($request->punch_in_time)){
        //     Attendance::create([
        //         ''
        //     ])
        // }
    }
}
