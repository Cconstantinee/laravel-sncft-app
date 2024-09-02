<?php

use App\Http\Controllers\FleetManagerController;
use App\Http\Controllers\FreightOperationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Models\Fleet_manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ScheduleController::class)->group(function () {
    Route::get('/schedules/{id}', 'show');
    Route::get('/schedules', 'index');
});



//my apis :)

Route::resource('/operations',FreightOperationController::class);
Route::resource('/locations',LocationController::class);
Route::resource('/fleet',FleetManagerController::class);