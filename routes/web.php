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
    return view('auth/login');
});

Auth::routes();

//Book module routes
Route::get('/', 'BookController@index')->name('home');
Route::get('home', 'BookController@index')->name('home');
Route::prefix('book')->group(function () {
	Route::get('/', 'BookController@index')->name('book.manage');
	Route::get('add', 'BookController@add')->name('book.add');
	Route::post('insert', 'BookController@insert')->name('book.insert');
	Route::get('edit/{id}', 'BookController@edit')->name('book.edit');
	Route::post('update', 'BookController@update')->name('book.update');  
	Route::get('delete/{id}', 'BookController@delete')->name('book.delete');
});

//Author module routes
Route::prefix('author')->group(function () {
	Route::get('/', 'AuthorController@index')->name('author.manage');
	Route::get('add', 'AuthorController@add')->name('author.add');
	Route::post('insert', 'AuthorController@insert')->name('author.insert');
	Route::get('edit/{id}', 'AuthorController@edit')->name('author.edit');
	Route::post('update', 'AuthorController@update')->name('author.update');  
});

//Export module routes
Route::prefix('export')->group(function () {
	Route::get('csv/{id}', 'ExportController@csv_export')->name('export.csv');
	Route::get('xml/{id}', 'ExportController@xml_export')->name('export.xml');
});
