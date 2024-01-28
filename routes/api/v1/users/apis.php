<?php

namespace users;

use App\Http\Controllers\Api\v1\users\UsersController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UsersController::class, 'index'])->middleware('userScopes:admin,staff')->name('list_users');
    Route::get('/me', [UsersController::class, 'me'])->middleware('userScopes:admin,staff')->name('me');
});
