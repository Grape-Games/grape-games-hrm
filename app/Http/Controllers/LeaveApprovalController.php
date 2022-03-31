<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaves;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveApprovalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmployeeLeaves::with(['owner', 'approvedBy', 'type'])->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)->make(true);
        }
        return view('pages.employee-leaves.index');
    }
    public function delete($id)
    {
        $model = EmployeeLeaves::findOrFail($id);

        if ($model->status == 'approved')
            return JsonResponseService::getJsonFailed('Cannot delete availed leave.');

        if ($model->delete())
            return JsonResponseService::getJsonSuccess('Employee leave was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete designation.');
    }
}
