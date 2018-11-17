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




Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/select/{university_id?}/{department_id?}/{course_id?}', 'HomeController@select')->name('home');

Route::get('/select/{university_id?}/{department_id?}/{course_id?}/dashboard', 'DashboardController@index');

Route::post('/like','PostController@postLikePost')->name('like');

Route::get('/admin', 'AdminController@index');

Route::get('/admin/university', 'AdminController@university');

Route::post('/admin/adduniversity', 'AdminController@addUniversity')->name('adduniversity');

Route::get('/admin/deleteuniversity/{id}', 'AdminController@deleteUniversity');

Route::get('/admin/{university_id?}/department', 'AdminController@department');

Route::post('/admin/{university_id?}/adddepartment', 'AdminController@addDepartment')->name('addDepartment');

Route::get('/admin/deletedepartment/{id}', 'AdminController@deleteDepartment');

Route::get('/admin/{university_id}/{department_id}/course', 'AdminController@course');

Route::post('/admin/{university_id}/{department_id}/addcourse', 'AdminController@addCourse');

Route::get('/admin/deletecourse/{id}', 'AdminController@deleteCourse');

Route::post('/{university_id?}/{department_id?}/{course_id?}/dashboard/upload','DashboardController@UploadPost');

#translate post upload
Route::post('/{university_id?}/{department_id?}/{course_id?}/dashboard/upload/{post_id?}/translation','DashboardController@UploadTranslationPost');

#route to download file
Route::get('/{university_id?}/{department_id?}/{course_id?}/dashboard/download/{filename}', ['as' => 'getFile', 'uses' => 'DashboardController@get_file']);
