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
    return view('welcome');
});

Route::get(
    '/socialite/{provider}',
    [
        'as' => 'socialite.auth',
        function ( $provider ) {
            return \Socialite::driver( $provider )->redirect();
        }
    ]
);

Route::get('/socialite/{provider}/callback', function ($provider) {
    $user = \Socialite::driver($provider)->user();
    dd($user);
});

/*Route::get(
    '/socialite/{provider}',
    [
        function ($provider) {
            return \Socialite::driver( $provider )->redirect();
        }
    ]
);

Route::get('/socialite/{provider}/callback', function ($provider) {
    $user = \Socialite::driver($provider)->user();
    dd($user);
});*/