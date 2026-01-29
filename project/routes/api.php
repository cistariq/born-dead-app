<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteBornController;
use App\Http\Controllers\DeadApiController;



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
