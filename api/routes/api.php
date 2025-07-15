<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);

    });
});

Route::prefix('account')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/store', [AccountController::class, 'store']);
        Route::get('/', [AccountController::class, 'index']);
        Route::get('/show/{account}', [AccountController::class, 'show']);
        Route::post('/delete/{account}', [AccountController::class, 'destroy']);

        Route::prefix('operation')->group(function () {
            Route::get('/', [OperationController::class, 'index']);
            Route::get('/show/{operation}', [OperationController::class, 'show']);
            Route::post('/store', [OperationController::class, 'store']);
            Route::post('/delete/{operation}', [OperationController::class, 'destroy']);
            Route::post('/update/{operation}', [OperationController::class, 'update']);



        });
    });

});