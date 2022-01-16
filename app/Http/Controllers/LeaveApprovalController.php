<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaves;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveApprovalController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployeeLeaves::with(['owner', 'approvedBy', 'type'])->get();
            return DataTables::of($data)->make(true);
        }
        return view('pages.employee-leaves.index');
    }
}
