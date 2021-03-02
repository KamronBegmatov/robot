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

Route::prefix('auth')->middleware(['web'])->group(function ($router) {
    Route::get('redirect', 'App\Http\Controllers\UserFromGoogleController@redirect');
    Route::get('callback', 'App\Http\Controllers\UserFromGoogleController@callback');
});

Route::prefix('auth')->group(function () {
    Route::post('registration', 'App\Http\Controllers\AuthController@registration');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::prefix('monitors')->group(function () {
    Route::get('/', 'App\Http\Controllers\MonitorController@index');
    Route::post('store', 'App\Http\Controllers\MonitorController@store');
    Route::post('{monitor}/update', 'App\Http\Controllers\MonitorController@update')->middleware('can:update,monitor');
    Route::post('{monitor}/destroy', 'App\Http\Controllers\MonitorController@destroy')->middleware('can:destroy,monitor');
});

Route::prefix('contacts')->group(function () {
    Route::get('/', 'App\Http\Controllers\ContactController@index');
    Route::post('store', 'App\Http\Controllers\ContactController@store');
    Route::post('{contact}/update', 'App\Http\Controllers\ContactController@update')->middleware('can:update,contact');
    Route::post('{contact}/destroy', 'App\Http\Controllers\ContactController@destroy')->middleware('can:destroy,contact');
});

Route::get('checkstatus', 'App\Models\Monitor@checkStatus');

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
