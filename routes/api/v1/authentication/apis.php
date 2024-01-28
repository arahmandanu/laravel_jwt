<?php

use App\Http\Controllers\Api\v1\AuthenticationController;
use App\Http\Middleware\Api\ValidUserRequest;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::post('login', [AuthenticationController::class, 'login'])->withoutMiddleware([ValidUserRequest::class])->name('jwt_login');
    Route::post('logout', [AuthenticationController::class, 'logout'])->name('jwt_logout');
});
