<?php

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\SalaryFormula;
use App\Models\SalarySlip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/employee.php';


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'can:is-admin'])->group(function () {
    Route::get('/dashboard/employees/{id}', function () {
        return redirect()->route('dashboard.employees.index');
    });

    Route::get('/dashboard/generate-slip', function () {
        return redirect()->route('dashboard.employee-salaries.index');
    });
});

Route::get('/test-query', function () {
    return Employee::with(['company', 'attendances' => function ($q) {
        $q->select('*', DB::table('attendances')->raw('DATE(attendance) as date'))
            ->whereMonth('attendance', Carbon::now()->month)
            ->groupBy('date', 'employee_id');
    }])->get();
    return view('tt', ['data' => Employee::with(['company', 'attendances' => function ($q) {
        $q->select('*', DB::table('attendances')->raw('DATE(attendance) as date'))
            ->whereMonth('attendance', Carbon::now()->month)
            ->groupBy('date');
    }])->first()]);
});


Route::get('/dashboard', function () {
    return view('dashboard', [
        'name' => auth()->user()->name
    ]);
})->middleware(['auth'])->name('dashboard');
