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
/*
 * Buerger
 */
Route::post("citizen/card/","BuergerController@showWithCard")->middleware("auth:api");//Post wegen hash
Route::get("citizen/name/{name}/lastname/{lastname}","BuergerController@showWithName")->middleware("auth:api");
Route::get("citizen/taxId/{taxId}","BuergerController@showWithSteuernummer")->middleware("auth:api");
Route::post("citizen/card/add","BuergerController@addCardToBuerger")->middleware("auth:api");
Route::delete("citizen/card/delete/{citizen}","BuergerController@removeCardFromBuerger")->middleware("auth:api");
Route::get("citizen/citizenship/all/{citizen}","StaatsbuergerschaftenController@getStaatsbuergerschaften")->middleware("auth:api");
Route::get("citizen/picture/id/{id}","BuergerController@getImage")->middleware("auth:api");
Route::post("citizen/add","BuergerController@storeCitizen")->middleware("auth:api");

/*
 * Staaten
 */
Route::get("state/all","StaatController@index")->middleware("auth:api");
Route::get("state/name/{name}","StaatController@showStateByName")->middleware("auth:api");
Route::get("state/id/{id}","StaatController@showStateById")->middleware("auth:api");
Route::post("state/add","StaatController@storeState")->middleware("auth:api");
Route::put("state/change","StaatController@storeState")->middleware("auth:api");
Route::delete("state/delete/{id}","StaatController@deleteState")->middleware("auth:api");
Route::get("state/citizens/all/{s_id}","StaatsbuergerschaftenController@getStaatsbuerger")->middleware("auth:api");

/*
 * Provinzen
 */
Route::get("province/all/{s_id}","ProvinzController@provinzenByState")->middleware("auth:api");
Route::get("province/name/{name}","ProvinzController@showProvinzByName")->middleware("auth:api");
Route::get("province/id/{id}","ProvinzController@showProvinzById")->middleware("auth:api");
Route::post("province/add","ProvinzController@storeProvinz")->middleware("auth:api");
Route::put("province/change","ProvinzController@storeProvinz")->middleware("auth:api");
Route::delete("province/delete/{id}","ProvinzController@deleteProvinz")->middleware("auth:api");

/*
 * Orte
 */
Route::get("place/all/{pr_id}","OrtController@placeByProvinz")->middleware("auth:api");
Route::get("place/name/{name}","OrtController@showPlaceByName")->middleware("auth:api");
Route::get("place/id/{id}","OrtController@showPlaceById")->middleware("auth:api");
Route::post("place/add","OrtController@storePlace")->middleware("auth:api");
Route::put("place/change","OrtController@storePlace")->middleware("auth:api");
Route::delete("place/delete/{id}","OrtController@deletePlace")->middleware("auth:api");

/*
 * Staatsbuergerschaften
 */
Route::post("citizenship/add","StaatsbuergerschaftenController@store");
Route::delete("citizenship/delete/citizen/{citizen}/state/{state}","StaatsbuergerschaftenController@delete");