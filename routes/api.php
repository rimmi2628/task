<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);


Route::middleware(['role:0'])->group(function () {
Route::post('/createCustomer',[UserController::class,'createCustomer']);
Route::post('/createOperator', [UserController::class,'createOperator']);
});

Route::middleware(['role:1'])->group(function () {
    Route::post('/updateCustomer',[UserController::class,'updateCustomer']);
    });

    Route::middleware(['role:2'])->group(function () {
Route::post('/updateOperator', [UserController::class,'updateOperator']);
});


