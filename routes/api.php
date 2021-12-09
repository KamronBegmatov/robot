<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;

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

Route::post('I4Bxu3px07ap1mlYncNMVwFgDWRyccZSlvpc2t7xtiaug7Xjlw4mxFt2kGcOamrz/webhook', function () {
    $telegram = new Api(config("telegram.bots.mybot.token"));
    $update = $telegram->addCommand(App\Telegram\Commands\HelpCommand::class);
    $updates = $telegram->commandsHandler(true);
});

Route::prefix('auth')->middleware(['web'])->group(function ($router) {
    Route::get('redirect', 'UserFromGoogleController@redirect');
    Route::get('callback', 'UserFromGoogleController@callback');
});

Route::prefix('auth')->group(function () {
    Route::post('registration', 'AuthController@registration');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::prefix('monitors')->group(function () {
    Route::get('/', 'MonitorController@index');
    Route::post('/', 'MonitorController@store');
    Route::put('/{monitor}', 'MonitorController@update')->middleware('can:update,monitor');
    Route::delete('/{monitor}', 'MonitorController@destroy')->middleware('can:destroy,monitor');
});

Route::prefix('contacts')->group(function () {
    Route::get('/', 'ContactController@index');
    Route::post('/', 'ContactController@store');
    Route::put('/{contact}', 'ContactController@update')->middleware('can:update,contact');
    Route::delete('/{contact}', 'ContactController@destroy')->middleware('can:destroy,contact');
});

Route::get('checkstatus', 'App\Models\Monitor@checkStatus');

//Route::group([
//
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//    Route::post('registration', 'AuthController@registration');
//    Route::post('login', 'AuthController@login');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('me', 'AuthController@me');
//
//});
