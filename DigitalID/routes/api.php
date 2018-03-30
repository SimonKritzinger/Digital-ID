<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BuergerController;
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

Route::post("buerger/card/","BuergerController@showWithCard");
Route::get("buerger/vorname/{vorname}/nachname/{nachname}","BuergerController@showWithName")->middleware('auth:api');
Route::get("buerger/steuernummer/{steuernummer}","BuergerController@showWithSteuernummer")->middleware('auth:api');
Route::post("buerger/card/add","BuergerController@addCardToBuerger")->middleware('auth:api');
Route::delete("buerger/card/delete/{bnummer}","BuergerController@removeCardFromBuerger")->middleware('auth:api');

Route::get("state/all","StaatController@index")->middleware('auth:api');
Route::get("state/name/{sname}","StaatController@showStateByName")->middleware('auth:api');
Route::get("state/id/{id}","StaatController@showStateById")->middleware('auth:api');
Route::post("state/add","StaatController@storeState")->middleware('auth:api');
Route::put("state/change","StaatController@storeState")->middleware('auth:api');
Route::delete("state/delete/{snummer}","StaatController@deleteState")->middleware('auth:api');

