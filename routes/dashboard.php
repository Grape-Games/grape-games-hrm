<?php

use App\Http\Controllers\AdminAttendanceManagementController;
use App\Http\Controllers\BiometricDeviceController;
use App\Http\Controllers\CompanyController;
// use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentTypeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeAccountCreateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LateMinutesController;
use App\Http\Controllers\LeaveApprovalController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ParentDesignationController;
use App\Http\Controllers\SalaryCronTestController;
use App\Http\Controllers\SalaryFormulaController;
use App\Http\Controllers\SalarySlipController;
use App\Models\Department;
use App\Services\JsonResponseService;
use Illuminate\Support\Facades\Route;

Route::get('salary-cron', SalaryCronTestController::class);


Route::group([
    'as' => 'dashboard.',
    'middleware' => ['auth', 'can:is-admin'],
    'prefix' => 'dashboard/'
], function () {
    Route::resource('companies', CompanyController::class);
    // Route::resource('departments', DepartmentController::class);
    Route::resource('department-type', DepartmentTypeController::class);
    Route::resource('parent-designations', ParentDesignationController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('employee-salaries', SalaryFormulaController::class);
    Route::resource('biometric-devices', BiometricDeviceController::class);
    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('employee-web-accounts', EmployeeAccountCreateController::class);
    Route::resource('notice-board', NoticeBoardController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('late-minutes', LateMinutesController::class);
    Route::get('employee-leave-approvals', LeaveApprovalController::class)->name('employee-leave-approvals');
    Route::post('save-salary-slip', SalarySlipController::class)->name('save-salary-slip');
    Route::get('manage-attendance', [AdminAttendanceManagementController::class, 'index'])->name('admin-attendance.management');
    Route::post('delete-punch', [AdminAttendanceManagementController::class, 'deletePunch'])->name('delete-punch');

    Route::delete('companies/dept/{id}', function ($id) {
        $companyId = Department::where('id', $id)->value('company_id');
        $count = Department::where('company_id', $companyId)->count();
        if ($count > 1)
            if (Department::where('id', $id)->delete())
                return JsonResponseService::getJsonSuccess('Department was deleted from the company successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete, company must have atleast 1 department.');
    });
});
