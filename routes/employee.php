<?php

use App\Http\Controllers\ActivitiesInvokeController;
use App\Http\Controllers\EmployeeAccountCreateController;
use App\Http\Controllers\EmployeeAttendanceaController;
use App\Http\Controllers\EmployeeLeavesController;
use App\Http\Controllers\EmployeeSalaryDetailsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeEvaluationController;
use App\Http\Livewire\Dashboard\Employee\AttendanceRequest;
use App\Http\Livewire\Dashboard\Finance\Accounts\MainComponent;
use App\Http\Livewire\MaterialRequestTracking;
use App\Http\Livewire\MaterialRequestTrackingIndex;
use App\Http\Livewire\RequestMaterialComponent;
use Illuminate\Support\Facades\Route;
use App\Models\EmployeeSalarySlip;
use App\Models\Evalutation;

Route::group([
    'as' => 'dashboard.',
    'middleware' => ['auth', 'can:is-both'],
    'prefix' => 'dashboard/'
], function () {
    Route::resource('events', EventController::class);
    Route::resource('leaves', EmployeeLeavesController::class);
    Route::resource('profile', ProfileController::class);
    Route::get('activites', ActivitiesInvokeController::class)->name('activites'); 
    Route::post('events/delete/custom', [EventController::class, 'delete2'])->name('events.delete2');
    Route::post('events/update/custom', [EventController::class, 'update2'])->name('events.update2');
    Route::post('events/create/custom', [EventController::class, 'create2'])->name('events.create2');
    Route::get('view-notice-board', [NoticeBoardController::class, 'viewBoard'])->name('view-notice-board');
    Route::post('update-pass/{id}', [EmployeeAccountCreateController::class, 'updatePassword'])->name('update-pass');
    Route::get('view-attendance', [EmployeeAttendanceaController::class, 'index'])->name('employee.attendance.index');
    Route::get('attendance-request', [EmployeeAttendanceaController::class, 'requestIndex'])->name('employee.attendance.request');
    Route::get('salary-report', [EmployeeSalaryDetailsController::class, 'reportIndex'])->name('employee.salary.report');
    Route::get('salary-slip', [EmployeeSalaryDetailsController::class, 'index'])->name('employee.salary.index');
    Route::post('print-salary-slip', [EmployeeSalaryDetailsController::class, 'printSalarySlip'])->name('employee.salary.print');
    Route::post('employee-evaluation-report', [EmployeeEvaluationController::class, 'employeeEvaluationReport'])->name('employee.evaluation.report');
    
    Route::get('employee-evaluation',[EmployeeEvaluationController::class,'index'])->name('employee-evaluation.index');
    // to generate a salary slip
    Route::get('/generate-slip/{id}', function ($id) {
        $result = EmployeeSalarySlip::where('id', $id)->with(['employee.company', 'employee.designation', 'employee.additional', 'employee.bank'])->first();
        if (!is_null($result))
            return view('pages.salary-slip.index', [
                'slip' => $result
            ]);
        abort(404);
    })->name('print-slip');
    Route::get('/generate-evaluation/{id}', function ($id) {
            $result = Evalutation::where('id',$id)->with('user')->first();
            return view('pages.employee-evaluation.generate.index',[
                'result' => $result
            ]);   
        
    })->name('generate.emp-evaluation'); 
});


Route::group([
    'as' => 'dashboard.livewire.',
    'prefix' => 'dashboard/'
], function () {
    Route::get('attendance-request-live', AttendanceRequest::class)->name('attendance.request')->middleware(['auth', 'can:is-both']);
    Route::get('finance-accounts', MainComponent::class)->name('finance.accounts')->middleware(['auth', 'can:is-both']);
    Route::get('material-request', RequestMaterialComponent::class)->name('material.request')->middleware(['auth']);
    Route::get('material-request/tracking/{id}', MaterialRequestTracking::class)->name('material.request.tracking')->middleware(['auth']);
    Route::get('material-request/tracking', MaterialRequestTrackingIndex::class)->name('material.request.tracking.index')->middleware(['auth']);
});
