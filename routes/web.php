<?php

use App\Models\Attendance;
use App\Models\SalaryFormula;
use App\Models\SalarySlip;
use Carbon\Carbon;
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

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Events\Dispatcher;

Route::get('/getScheduleCommands', function () {
    new \App\Console\Kernel(app(), new Dispatcher());
    $schedule = app(Schedule::class);
    dd($schedule->events());

    // return $scheduledCommands;
});


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


Route::get('jsonview', function () {
    Attendance::create([
        "employee_id" => "162426ea-c031-47ca-9cef-9eb273489d06",
        "biometric_device_id" => 1,
        "attendance" => Carbon::now()
    ]);
    return '{"2022-02-01":[{"id":170,"employee_id":"162426ea-c031-47ca-9cef-9eb273489d06","biometric_device_id":1,"attendance":"Tuesday February 1, 2022, 1:02 am","deleted_at":null,"created_at":"2022-02-01T02:00:05.000000Z","updated_at":"2022-02-01T02:00:05.000000Z","employee":{"id":"162426ea-c031-47ca-9cef-9eb273489d06","first_name":"Abdullah","last_name":"Hamid","gender":"male","father_name":"Hamid Mehmood","primary_contact":"03365595662","secondary_contact":"03365595662","email_address":"abdullahhamid1995@hotmail.com","city":"Islamabad","cnic":"37405-4999949-3","enrollment_no":"5","registration_no":"15e478f112","company_id":"5a1b703a-9e7e-4fb3-bf6b-b9b48a485104","designation_id":37,"owner_id":"ed53a80b-4a0b-427b-a976-ba42324a416f","user_id":"876b6041-eabc-4f79-9761-bc615c54ddb5","deleted_at":null,"created_at":"2022-01-28T07:53:09.000000Z","updated_at":"2022-01-28T07:53:50.000000Z","biometric_device_id":1}},{"id":200,"employee_id":"162426ea-c031-47ca-9cef-9eb273489d06","biometric_device_id":1,"attendance":"Tuesday February 1, 2022, 10:12 am","deleted_at":null,"created_at":"2022-02-01T11:00:05.000000Z","updated_at":"2022-02-01T11:00:05.000000Z","employee":{"id":"162426ea-c031-47ca-9cef-9eb273489d06","first_name":"Abdullah","last_name":"Hamid","gender":"male","father_name":"Hamid Mehmood","primary_contact":"03365595662","secondary_contact":"03365595662","email_address":"abdullahhamid1995@hotmail.com","city":"Islamabad","cnic":"37405-4999949-3","enrollment_no":"5","registration_no":"15e478f112","company_id":"5a1b703a-9e7e-4fb3-bf6b-b9b48a485104","designation_id":37,"owner_id":"ed53a80b-4a0b-427b-a976-ba42324a416f","user_id":"876b6041-eabc-4f79-9761-bc615c54ddb5","deleted_at":null,"created_at":"2022-01-28T07:53:09.000000Z","updated_at":"2022-01-28T07:53:50.000000Z","biometric_device_id":1}}]}';
});


Route::get('/dashboard', function () {
    return view('dashboard', [
        'name' => auth()->user()->name
    ]);
})->middleware(['auth'])->name('dashboard');
