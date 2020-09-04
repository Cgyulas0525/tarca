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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dictionaries', 'DictionaryController');
Route::resource('types', 'TypeController');
Route::resource('partners', 'PartnerController');
Route::resource('koltsegcsoports', 'KoltsegcsoportController');
Route::resource('koltsegfocsoports', 'KoltsegfocsoportController');
Route::resource('telepules', 'TelepulesController');
Route::resource('termekfocsoports', 'termekfocsoportController');
Route::resource('termekcsoports', 'termekcsoportController');
Route::resource('termeks', 'termekController');
Route::resource('szamlas', 'szamlaController');
Route::resource('szamlatetels', 'szamlatetelController');
Route::resource('todos', 'TodoController');

Route::get('dictionaries/destroyMe/{id}', 'DictionaryController@destroyMe')->name('SzotarTorles');
Route::get('koltsegfocsoports/destroyMe/{id}', 'KoltsegfocsoportController@destroyMe')->name('KtgFoCsoportTorles');
Route::get('koltsegcsoports/destroyMe/{id}', 'KoltsegcsoportController@destroyMe')->name('KtgCsoportTorles');
Route::get('partners/destroyMe/{id}', 'PartnerController@destroyMe')->name('PartnerTorles');
Route::get('telepules/destroyMe/{id}', 'TelepulesController@destroyMe')->name('TelepulesTorles');
Route::get('termeks/destroyMe/{id}', 'termekController@destroyMe')->name('TermekTorles');
Route::get('termekfocsoports/destroyMe/{id}', 'termekfocsoportController@destroyMe')->name('TermekFoCsoportTorles');
Route::get('termekcsoports/destroyMe/{id}', 'termekcsoportController@destroyMe')->name('TermekCsoportTorles');
Route::get('szamlatetels/destroyMe/{id}', 'szamlatetelController@destroyMe')->name('SzamlaTetelTorles');
Route::get('szamlas/destroyMe/{id}', 'szamlaController@destroyMe')->name('SzamlaTorles');
Route::get('todos/destroyMe/{id}', 'TodoController@destroyMe')->name('TodoTorles');
Route::get('todos/updateVege/{id}', 'TodoController@updateVege')->name('UpdateVege');

Route::get('koltsegcsoports/createMe/{id}', 'KoltsegcsoportController@createMe')->name('KtgCsoportInsert');
Route::get('termekcsoports/createMe/{id}', 'termekcsoportController@createMe')->name('TermekCsoportInsert');
Route::get('dictionaries/createMe/{id}', 'DictionaryController@createMe')->name('SzotarInsert');
Route::get('szamlatetels/createMe/{id}', 'szamlatetelController@createMe')->name('SzamlaTetelInsert');

Route::post('/api/getTelepulesList','ApiController@getTelepulesList');
Route::post('/api/getFocsoportFromCsoport','ApiController@getFocsoportFromCsoport');
Route::post('/api/getMaxSzolgaltatasCikkszam','ApiController@getMaxSzolgaltatasCikkszam');
Route::post('/api/getMaxTermekCikkszam','ApiController@getMaxTermekCikkszam');
Route::post('/api/getAfaSzazalek','ApiController@getAfaSzazalek');
