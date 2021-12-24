<?php

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
    'as' => 'zkteco.'
], function () {
    Route::get('{ip}/getAttendance', [ZKTecoApiService::class, 'getAttendance'])->name('get-attendance');
    Route::get('{ip}/setAttendance', [ZKTecoApiService::class, 'setAttendance'])->name('set-attendance');
    Route::get('{ip}/getUsers', [ZKTecoApiService::class, 'getUsers'])->name('users');
    Route::get('{ip}/restart', [ZKTecoApiService::class, 'restartDevice'])->name('restart');
    Route::get('{ip}/getDeviceTime', [ZKTecoApiService::class, 'getDeviceTime'])->name('device-time');
    Route::post('test', [ZKTecoApiService::class, 'test'])->name('test');
});
