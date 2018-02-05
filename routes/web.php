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

Route::get('/', 'DealController@index')->name('home');

//  Deals
Route::resource('deals', 'DealController');

//  Agent
Route::prefix('agent')->middleware('auth')->group(function () {
    //  deal - concrete
    Route::resource('deal', 'Api\DealController');
    //  objects
    Route::resource('objects', 'Api\ObjectController');
    //  elements
    Route::resource('elements', 'Api\ElementController');
    //  sections
    Route::post('sections', 'Api\SectionController@store'); // create
    Route::get('sections/parent/{id}', 'Api\SectionController@parent');
    // parent types
    Route::post('types', 'Api\TypeController@store'); // create
    Route::get('types/parent/{id}', 'Api\TypeController@parent');
    // parent (type) systems
    Route::post('systems', 'Api\SystemController@store'); // create
    Route::get('systems/parent/{id}', 'Api\SystemController@parent');
});

//  Update GIT & Composer
Route::prefix('update')->middleware('auth')->group(function () {

    function execPrint($command)
    {
        $result = array();
        exec($command, $result);
        foreach ($result as $line) {
            print("{$line}\n</br>");
        }
    }

    /*
     *  GIT Pull route
     */
    Route::get('git', function () {
        print("<pre>" . execPrint("git pull") . "</pre>");
    });

    /*
     *  Composer update route
     */
    Route::get('composer', function () {
        print("<pre>" . execPrint("composer update") . "</pre>");
    });

});
