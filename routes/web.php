<?php

use App\Models\SalaryFormula;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard/employees/{id}', function () {
    return redirect()->route('dashboard.employees.index');
});
Route::get('/dashboard/generate-slip', function () {
    return redirect()->route('dashboard.employee-salaries.index');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'name' => auth()->user()->name
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/generate-slip/{id}', function ($id) {
    $result = SalaryFormula::where('id', $id)->with(['employee', 'employee.department', 'employee.designation', 'employee.additional', 'employee.bank'])->first();
    if (!is_null($result))
        return view('pages.salary-slip.index', [
            'slip' => $result
        ]);
    abort(404);
})->name('print-slip');
