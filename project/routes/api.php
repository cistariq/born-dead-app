<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteBornController;
use App\Http\Controllers\DeadApiController;
use App\Http\Controllers\dead\DeadController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test',function(){
    echo "API is working";

//
});
Route::post('/generateToken', [QuoteBornController::class, 'generateToken']);
Route::post('/getQuota', [QuoteBornController::class, 'getQuota']);
Route::post('/updateDeadSource', [DeadApiController::class, 'updateDeadSource']);

Route::post('/check_citizen_id', [DeadController::class, 'check_citizen_id']);
