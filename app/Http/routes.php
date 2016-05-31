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

Route::get('/', function () {
    return view('index');
});

Route::get('/article/{id}', 'ArticlesController@show');

Route::get('/unigram', 'UnigramsController@index');
Route::get('/unigram/{unigram}/{intent}', 'UnigramsController@show');
Route::post('/unigram/{unigram}', 'UnigramsController@verify');
Route::patch('/unigram/{unigram}', 'UnigramsController@update');
Route::delete('/unigram/{unigram}', 'UnigramsController@destroy');

Route::get('/bigram', 'BigramsController@index');
Route::get('/bigram/{bigram}/{intent}', 'BigramsController@show');
Route::post('/bigram/{bigram}', 'BigramsController@verify');
Route::patch('/bigram/{bigram}', 'BigramsController@update');
Route::delete('/bigram/{bigram}', 'BigramsController@destroy');

Route::get('/trigram', 'TrigramsController@index');
Route::get('/trigram/{trigram}/{intent}', 'TrigramsController@show');
Route::post('/trigram/{trigram}', 'TrigramsController@verify');
Route::patch('/trigram/{trigram}', 'TrigramsController@update');
Route::delete('/trigram/{trigram}', 'TrigramsController@destroy');
