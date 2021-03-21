<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Auth\AuthAPIController@login');
Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::get('current-user', 'Auth\AuthAPIController@currentUser');
    Route::get('logout','Auth\AuthAPIController@logout');
});


Route::get('teacher','ApiController@teacher');

// Route::group(['middleware' => ['auth','role:Teacher']], function () 
// {
//     // Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
//     // Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');

//     //Assignment manager
//     Route::resource('assignment-manager', 'AssignmentController');
//     Route::get('assignment-manager/create/{id}', 'AssignmentController@create')->name('assignment-manager.create-assignment');
//     Route::post('assignment-manager/create/store/{id}','AssignmentController@store')->name('assignment-manager.store-assignment');
//     Route::get('assignment-manager/download/{file}', 'AssignmentController@download_file')->name('assignment-manager.download');
//     Route::post('assignment-manager/scoring/{id}','AssignmentController@score')->name('assignment-manager.scoring');
    
//     //Virtual Classroom
//     Route::post('/home/update-virtual-classroom/{id}','GradeController@update_virtual_classroom')->name('update-virtual-classroom');
// });

// Route::group(['middleware' => ['auth','role:Student']], function () 
// {
//     //Assignment
//     Route::get('assignments', 'AssignmentController@student')->name('assignment.student');
//     Route::get('assignments/submit/{id}', 'AssignmentController@submit')->name('assignment.submit');
//     Route::post('assignments/store{assignment_id}&{assignment_title}', 'AssignmentController@store_assignment')->name('assignment.store-assignment');
// });
