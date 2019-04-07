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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login', 'Api\UserController@login');
Route::get('logout', 'Api\UserController@logout');

Route::group([
    'as' => 'api.',
    'namespace' => 'Api',
    'middleware' => 'jwt.auth',
], function () {

    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::post('', 'UserController@store')->name('store');
        Route::get('{user}/show', 'UserController@show')->name('show');
        Route::put('{user}/update', 'UserController@update')->name('update');
        Route::post('{user}/destroy', 'UserController@destroy')->name('destroy');
    });

});
