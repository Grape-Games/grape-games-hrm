<?php

use App\Http\Controllers\ActivitiesInvokeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'dashboard.',
    'middleware' => ['auth', 'can:is-both'],
    'prefix' => 'dashboard/'
], function () {
    Route::resource('events', EventController::class);
    Route::resource('profile', ProfileController::class);
    Route::get('activites', ActivitiesInvokeController::class)->name('activites');
    Route::post('events/delete/custom', [EventController::class, 'delete2'])->name('events.delete2');
    Route::post('events/update/custom', [EventController::class, 'update2'])->name('events.update2');
    Route::post('events/create/custom', [EventController::class, 'create2'])->name('events.create2');
});
