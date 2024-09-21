<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/company', [CompanyController::class, 'create']);
    Route::get('/company', [CompanyController::class, 'view']);
    Route::patch('/company/{id}', [CompanyController::class, 'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']);
    Route::post('/employee', [EmployeeController::class, 'create']);
    Route::get('/employee', [EmployeeController::class, 'view']);
    Route::patch('/employee/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);

});
