<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([

    'middleware' => 'web',
    'prefix' => 'auth'

], function ($router){
Route::get('redirect', 'App\Http\Controllers\UserFromGoogleController@redirect');
Route::get('callback', 'App\Http\Controllers\UserFromGoogleController@callback');

});

Route::group([

    'prefix' => 'auth'

], function ($router) {
    Route::post('registration', 'App\Http\Controllers\AuthController@registration');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

//Route::group([
//
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//    Route::post('registration', 'App\Http\Controllers\AuthController@registration');
//    Route::post('login', 'App\Http\Controllers\AuthController@login');
//    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
//    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
//    Route::post('me', 'App\Http\Controllers\AuthController@me');
//
//});
