<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentTypeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ParentDesignationController;
use App\Http\Controllers\SalaryFormulaController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'dashboard.',
    'middleware' => 'auth',
    'prefix' => 'dashboard/'
], function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('department-type', DepartmentTypeController::class);
    Route::resource('parent-designations', ParentDesignationController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('employee-salaries', SalaryFormulaController::class);
});
