<?php

Route::post('login', 'Auth\AuthAPIController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', 'Auth\AuthAPIController@profile');
    Route::post('logout', 'Auth\AuthAPIController@logout');
});
