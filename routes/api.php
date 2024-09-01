<?php

use App\Http\Controllers\FreightOperationController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ScheduleController::class)->group(function () {
    Route::get('/schedules/{id}', 'show');
    Route::get('/schedules', 'index');
});



Route::controller(FreightOperationController::class)->group(function(){
    Route::get('/operations/{id}', 'show');
    Route::get('/operations', 'index');
});