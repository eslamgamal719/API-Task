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


Route::get('/', function () {
    return view('welcome');
})->middleware('guest');



//workers routes
Route::resource('workers', 'Api\WorkerController')->except(['create', 'edit']);


//months routes
Route::resource('statistics', 'Api\MonthController')->except(['create', 'edit']);


//get statistics for remainder months
Route::get('get-Remainder-Months', 'Api\MonthController@getRemainderMonths');

//get token route
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
