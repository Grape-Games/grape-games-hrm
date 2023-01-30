<?php

use App\Http\Controllers\SalaryCronTestController;
use App\Http\Controllers\SalarySlipController;
use App\Models\Attendance;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Artisan call for instant attendnace refresh
Route::get('/refresh-data', function() {
    Artisan::call('zkteco:fetch');
    return 'Attendances have been updated!';
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/employee.php';


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'can:is-universal'])->group(function () {
    Route::get('/dashboard/employees/{id}', function () {
        return redirect()->route('dashboard.employees.index');
    });

    Route::get('/dashboard/generate-slip', function () {
        return redirect()->route('dashboard.employee-salaries.index');
    });
});

Route::get('/test-query', function () {
    $employees = Attendance::whereDate('attendance', '2022-02-25')->groupBy('employee_id')->get();
    foreach ($employees as $key => $value) {
        # code...
        Attendance::create([
            'employee_id' => $value->employee_id,
            'biometric_device_id' => 1,
            'attendance' => "2022-02-25 19:00:00"
        ]);
    }
    dd('done');
});

Route::get('/test-cron', SalaryCronTestController::class);


Route::get('/dashboard', function () {
    return view('dashboard', [
        'name' => auth()->user()->name
    ]); 
})->middleware(['auth'])->name('dashboard');
