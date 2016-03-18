<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => ['api', 'cors'], 'prefix' => 'api/v1'], function () {

    Route::post('raw-data', 'RawDataController@store');
    Route::get('raw-data', 'RawDataController@index');

//    Route::get('parse-data', 'ParserController@parse');

    Route::post('words', [
        'as' => 'post.words',
        'uses' => 'WordsController@postWords'
    ]);

    Route::get('max-frequence', [
        'as' => 'post.words',
        'uses' => 'WordsController@wordFrequence'
    ]);
});
