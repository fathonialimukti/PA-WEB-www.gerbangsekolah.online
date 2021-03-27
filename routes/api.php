<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('login', 'Auth\AuthAPIController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', 'Auth\AuthAPIController@profile');
    Route::post('logout', 'Auth\AuthAPIController@logout');
});
