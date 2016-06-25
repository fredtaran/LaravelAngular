<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get( '/', 'filesController@index' );

Route::post( '/', 'filesController@upload' );

Route::get( '/list', 'filesController@search' );

Route::get( '/view/{id}', 'filesController@view' );

Route::get( '/delete/{id}', 'filesController@delete' );