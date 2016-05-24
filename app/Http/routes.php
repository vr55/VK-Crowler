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

Route::group( ['middleware' => 'web'], function () {
	Route::get( '/', ['as' => 'home', 'uses' => 'mcIndexController@getIndex']);
    Route::get( 'update', ['as' =>'update', 'uses' => 'mcUpdateController@getData'] );

	Route::get( 'keywords', ['as' => 'keywords', 'uses' => 'mcIndexController@getKeywords']);
	Route::post( 'keywords', ['as' => 'keywords', 'uses' => 'mcIndexController@postKeywords']);

	Route::get( 'comunities', ['as' => 'comunities', 'uses' => 'mcIndexController@getComunities']);
	Route::post( 'comunities', ['uses' => 'mcIndexController@postComunities']);

	Route::get( 'proposal', ['as' => 'proposal', 'uses' => 'mcIndexController@getProposals'] );
	Route::post( 'proposal', ['as' => 'proposal', 'uses' => 'mcIndexController@postProposals'] );

	Route::get( 'settings', ['as' => 'settings', 'uses' => 'mcIndexController@getSettings']);
	Route::post( 'settings', ['uses' => 'mcIndexController@postSettings']);
});

Route::get( 'message', ['uses' => 'mcUpdateController@sendMessage']);
Route::get( 'mail', ['uses' => 'mcUpdateController@sendMail']);