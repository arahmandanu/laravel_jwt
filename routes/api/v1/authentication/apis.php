<?php

use App\Http\Controllers\Api\v1\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::post('login', [AuthenticationController::class, 'login'])->name('jwt_login');
});
