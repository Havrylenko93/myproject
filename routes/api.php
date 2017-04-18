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
Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
        Route::group(['prefix' => 'facebook', 'as' => 'facebook.'], function () {
            Route::post('/getProfile', ['as' => 'getProfile', 'uses' => 'GetController@getProfile']);
            Route::post('/deleteUser', ['as' => 'deleteUser', 'uses' => 'GetController@deleteUser']);
            Route::post('getUsers/{flag}', ['as'=>'getUsers', 'uses'=>'GetController@GetUsers']);
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
