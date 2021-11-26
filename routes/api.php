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

Route::get('comunas/{id_region?}', 'ImaxdControllers\ComunaController@getComunas')->name('api-comunas');
Route::get('fullypde/{imaxd_user_id}/{json_responses?}', 'ImaxdControllers\HomeController@isFull')->name('api-full');
