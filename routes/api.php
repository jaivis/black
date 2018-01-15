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

//  elements
Route::middleware('auth:api')->resource('elements', 'Api\ElementController');
//  sections
Route::middleware('auth:api')->get('sections/parent/{id}', 'Api\SectionController@parent');
// parent types
Route::middleware('auth:api')->get('types/parent/{id}', 'Api\TypeController@parent');
// parent (type) systems
Route::middleware('auth:api')->get('systems/parent/{id}', 'Api\SystemController@parent');
