<?php

namespace users;

use Illuminate\Support\Facades\Route;


Route::resource('users', UsersController::class);
