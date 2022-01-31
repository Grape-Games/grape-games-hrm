<?php

use App\Http\Controllers\ActivitiesInvokeController;
use App\Http\Controllers\EmployeeAccountCreateController;
use App\Http\Controllers\EmployeeAttendanceaController;
use App\Http\Controllers\EmployeeLeavesController;
use App\Http\Controllers\EmployeeSalaryDetailsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ProfileController;
use App\Models\SalarySlip;
use Illuminate\Support\Facades\Route;

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

    // to generate a salary slip
    Route::get('/generate-slip/{id}', function ($id) {
        $result = SalarySlip::where('id', $id)->with(['employee', 'employee.company', 'employee.designation', 'employee.additional', 'employee.bank'])->first();
        if (!is_null($result))
            return view('pages.salary-slip.index', [
                'slip' => $result
            ]);
        abort(404);
    })->name('print-slip');
});
