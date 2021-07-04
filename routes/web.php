<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function ()
{
    // Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    // Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    // Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    // Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    // Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    // Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    // Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    // Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    // Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::resource('assignrole', 'RoleAssign');
    Route::resource('grade', 'GradeController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('student', 'StudentController');

    Route::get('/search/grade', 'GradeController@search');
    Route::get('/search/student', 'StudentController@search');
    // Route::get('attendance', 'AttendanceController@index')->name('attendance.index');

});

Route::group(['middleware' => ['auth','role:Teacher']], function ()
{
    // Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    // Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');

    //Assignment manager
    Route::resource('assignment-manager', 'AssignmentController');
    Route::get('assignment-manager/create/{id}', 'AssignmentController@create')->name('assignment-manager.create-assignment');
    Route::post('assignment-manager/create/store/{id}','AssignmentController@store')->name('assignment-manager.store-assignment');
    Route::get('assignment-manager/download/{file}', 'AssignmentController@downloadFile')->name('assignment-manager.download');
    Route::post('assignment-manager/scoring/{id}','AssignmentController@score')->name('assignment-manager.scoring');

    //Virtual Classroom
    Route::post('/home/update-virtual-classroom/{id}','GradeController@updateVirtualClassroom')->name('update-virtual-classroom');
});

Route::group(['middleware' => ['auth','role:Student']], function ()
{
    //Assignment
    Route::get('assignments', 'AssignmentController@student')->name('assignment.student');
    Route::get('assignments/submit/{id}', 'AssignmentController@submit')->name('assignment.submit');
    Route::post('assignments/submit-assignment/{id}', 'AssignmentController@submitAssignment')->name('assignment.submit-assignment');
});

// now for payment system

Route::group(['middleware' => 'auth'], function (){
    Route::get('payment/show/{id}', 'PaymentController@show')->name('payment.show');
});
