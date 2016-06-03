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

Route::group( [ 'middleware' => 'sentinel.guest'], function(){
	Route::get( 'login', ['as' => 'login', 'uses' => 'mcUserController@getLogin'] );
	Route::post( 'login', ['as' => 'login', 'uses' => 'mcUserController@postLogin'] );

	Route::get( 'register', ['as' => 'register', function(){ return view('register'); }]);
	Route::post( 'register', ['as' => 'register', 'uses' => 'mcUserController@postRegister']);
});

Route::group( [ 'middleware' => 'sentinel.auth'], function () {
	Route::get( '/', ['as' => 'home', 'uses' => 'mcIndexController@getIndex']);
	Route::get( 'logout', ['as' => 'logout', 'uses' => 'mcUserController@getLogout'] );



	Route::get( 'keywords', ['as' => 'keywords', 'uses' => 'mcIndexController@getKeywords']);
	Route::post( 'keywords', ['as' => 'keywords', 'uses' => 'mcIndexController@postKeywords']);
	Route::get( 'keywords/delete/{id}', ['as' => 'keyword.delete', 'uses' => 'mcIndexController@getDeleteKeyword'] )->where( 'id', '[0-9]+');

	Route::get( 'comunities', ['as' => 'comunities', 'uses' => 'mcIndexController@getComunities']);
	Route::post( 'comunities', ['uses' => 'mcIndexController@postComunities']);
	Route::get( 'comunities/delete/{id}', [ 'as' =>'comunity.delete', 'uses' => 'mcIndexController@getDeleteComunity'] )->where( 'id', '[0-9]+');

	Route::get( 'proposal', ['as' => 'proposal', 'uses' => 'mcIndexController@getProposals'] );
	Route::post( 'proposal', ['as' => 'proposal', 'uses' => 'mcIndexController@postProposals'] );
	Route::get( 'proposal/delete/{id}', ['as' =>'proposal.delete', 'uses' => 'mcIndexController@getDeleteProposal'])->where( 'id', '[0-9]+' );

	Route::get( 'settings', ['as' => 'settings', 'uses' => 'mcIndexController@getSettings']);
	Route::post( 'settings', ['uses' => 'mcIndexController@postSettings']);

	Route::get( 'post/delete/{id}', ['as' => 'post.delete', 'uses' => 'mcIndexController@getDeletePost'] )->where( 'id', '[0-9]+' );

	Route::get( 'message/to/{id}', ['as' => 'message', 'uses' => 'mcUpdateController@getSendMessage'] )->where( 'id', '[0-9]+' );

	Route::get( 'xmpp', ['as' =>'xmpp', 'uses' => 'mcXmppController@getSendMessage'] );

});
	Route::get( 'update', ['as' =>'update', 'uses' => 'mcUpdateController@getData'] );

//	Route::get( 'xmpp', ['uses' => 'mcXmppController@getSendMessage'] );
//Route::get( 'mail', ['uses' => 'mcUpdateController@sendMail']);

//Route::get( 'message/{id}/{message}', ['uses' => 'mcUpdateController@sendMessage']);
