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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/', 'DealController@index');
Route::get('/home', 'DealController@index')->name('home');

//  Deals
Route::resource('deals', 'DealController');

//  Agent
Route::prefix('agent')->middleware('auth')->group(function () {
    //  elements
    Route::resource('elements', 'Api\ElementController');
    //  sections
    Route::post('sections', 'Api\SectionController@store'); // create
    Route::get('sections/parent/{id}', 'Api\SectionController@parent');
    // parent types
    Route::get('types/parent/{id}', 'Api\TypeController@parent');
    // parent (type) systems
    Route::get('systems/parent/{id}', 'Api\SystemController@parent');
});

