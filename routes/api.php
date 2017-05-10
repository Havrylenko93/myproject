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
            /*Route::post('/getProfile', ['as' => 'getProfile', 'uses' => 'GetController@getProfile']);*/
            Route::post('/deleteUser', ['as' => 'deleteUser', 'uses' => 'GetController@deleteUser']);
            Route::post('getUsers/{flag}', ['as'=>'getUsers', 'uses'=>'GetController@GetUsers']);
            Route::post('/updateOrCreateUser', ['as' => 'updateOrCreateUser', 'uses' => 'GetController@updateOrCreateUser']);

        });
        Route::group(['prefix' => 'vk', 'as' => 'vk.'], function () {
            Route::any('/updateOrCreateUser', ['as' => 'updateOrCreateUser', 'uses' => 'VkController@updateOrCreateUser']);
            Route::any('/deleteUser', ['as' => 'deleteUser', 'uses' => 'VkController@deleteUser']);
            Route::any('getUsers/{flag}', ['as'=>'getUsers', 'uses'=>'VkController@GetUsers']);
        });
        Route::group(['prefix' => 'instagram', 'as' => 'vk.'], function () {
            Route::any('/getLikes', ['as' => 'getLikes', 'uses' => 'InstagramController@getLikes']);
            Route::any('/redirect', ['as' => 'redirect', 'uses' => 'InstagramController@redirect']);
        });
    });
    Route::any('test', ['as'=>'test', 'uses'=>'test@myrun']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
