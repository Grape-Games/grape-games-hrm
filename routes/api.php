<?php

use App\Http\Controllers\Api\EmployeeAttendanceController;
use App\Http\Controllers\Api\GlobalDataProvider;
use App\Services\NodeZkTecoService;
use App\Services\ZKTecoApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'prefix' => 'ZKteco/',
    'as' => 'zkteco.',
], function () {
    Route::get('js/getDeviceUsers', [ZKTecoApiService::class, 'getDeviceUser'])->name('get-device-users'); 
    Route::get('{ip}/getAttendance', [ZKTecoApiService::class, 'getAttendance'])->name('get-attendance');
    Route::get('{ip}/setAttendance', [ZKTecoApiService::class, 'setAttendance'])->name('set-attendance');
    Route::get('{ip}/getUsers', [ZKTecoApiService::class, 'getUsers'])->name('users');
    Route::get('{ip}/restart', [ZKTecoApiService::class, 'restartDevice'])->name('restart');
    Route::get('{ip}/getDeviceTime', [ZKTecoApiService::class, 'getDeviceTime'])->name('device-time');
});  
  

Route::group([
    'prefix' => 'ZKteco/node/',
    'as' => 'zkteco.node.'
], function () {
    // node library routes here
    Route::post('saveDataToDevice', [NodeZkTecoService::class, 'saveDataToDevice'])->name('saveDataToDevice');  
    Route::post('saveUsersToDevice', [NodeZkTecoService::class, 'saveUsersToDevice'])->name('saveUsersToDevice');
    Route::post('saveAttendanceToDevice', [NodeZkTecoService::class, 'saveAttendanceToDevice'])->name('saveAttendanceToDevice');
    Route::get('getDevices', [NodeZkTecoService::class, 'getDevices'])->name('getDevices');
    Route::post('saveLogs', [NodeZkTecoService::class, 'saveLogs'])->name('saveLogs');
});

Route::group([
    'prefix' => 'employee/attendance/',
    'as' => 'api.employee.attendance.'
], function () {
    Route::post('save', [EmployeeAttendanceController::class, 'save'])->name('save-attendance');
    Route::post('get', [EmployeeAttendanceController::class, 'get'])->name('get-attendance');
});


Route::group([
    'as' => 'json.'
], function () {
    Route::get('getCompanyEmployees', [GlobalDataProvider::class, 'getCompanyEmployees'])->name('getCompanyEmployees');
    Route::get('getEmployeePresentDays', [GlobalDataProvider::class, 'getEmployeePresentDays'])->name('getEmployeePresentDays');
    Route::get('getEmployeeAbsentDays', [GlobalDataProvider::class, 'getEmployeeAbsentDays'])->name('getEmployeeAbsentDays');
    Route::get('getEmployeeLeavesApproved', [GlobalDataProvider::class, 'getEmployeeLeavesApproved'])->name('getEmployeeLeavesApproved');
    Route::get('getEmployeeLateMinutes', [GlobalDataProvider::class, 'getEmployeeLateMinutes'])->name('getEmployeeLateMinutes');  
});