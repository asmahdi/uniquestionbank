<?php

use Illuminate\Http\Request;

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
Route::group([
    'prefix' => 'public'
    ], function () {
        Route::get('/universities', 'API\APIController@getUniversities');
        Route::post('/departments', 'API\APIController@getDepartments');
        Route::post('/courses', 'API\APIController@getCourses');
        Route::get('/resources','API\APIController@getResources');
    });

Route::group([
    'middleware' => 'auth:api'
        ], function () {
            Route::get('/post', 'API\APIController@getUniversities');
        });

Route::group([
    'prefix' => 'auth'
    ], function () {
    Route::post('login', 'API\AuthController@login');
    Route::post('signup', 'API\AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\AuthController@logout');
        Route::get('user', 'API\AuthController@user');
    });
});
