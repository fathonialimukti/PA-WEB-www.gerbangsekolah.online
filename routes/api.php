<?php

Route::post('login', 'Auth\AuthAPIController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', 'Auth\AuthAPIController@profile');
    Route::get('logout', 'Auth\AuthAPIController@logout');

    // Teacher Act
    Route::post('teacher/update-virtual-classroom', 'TeacherAPIController@updateVirtualClassroom');
    Route::get('teacher/get-assignment', 'TeacherAPIController@getAssignment');
    Route::post('teacher/create-assignment', 'TeacherAPIController@createAssignment');
    Route::post('teacher/delete-assignment', 'TeacherAPIController@deleteAssignment');
    Route::get('teacher/get-assignment-files/{id}', 'TeacherAPIController@getAssignmentFile');
    Route::get('teacher/download/{file}', 'TeacherAPIController@downloadFile');
    // Student Act
    }
);


