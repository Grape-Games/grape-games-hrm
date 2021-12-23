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
    Route::get('{ip}/attendance', [ZKTecoApiService::class, 'getAttendance'])->name('attendance');
    Route::get('{ip}/users', [ZKTecoApiService::class, 'getUsers'])->name('users');
});
