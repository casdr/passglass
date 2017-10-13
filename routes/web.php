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
    return redirect('/companies');
});

Auth::routes();

Route::group(['prefix' => 'companies', 'middleware' => 'auth', 'as' => 'companies.'], function () {
    Route::get('/', 'CompanyController@getIndex')->name('index');
    Route::get('add', 'CompanyController@getAdd')->name('add');
    Route::post('add', 'CompanyController@postAdd')->name('add');
    Route::get('{company}', 'CompanyController@getView')->name('view');
});

Route::group(['prefix' => 'contacts', 'middleware' => 'auth', 'as' => 'contacts.'], function () {
    Route::get('{contact}', 'ContactController@getView')->name('view');
    Route::get('{contact}/delete', 'ContactController@getDelete')->name('delete');
    Route::get('add/{company}', 'ContactController@getAdd')->name('add');
    Route::post('add/{company}', 'ContactController@postAdd')->name('add');
});

Route::group(['prefix' => 'passwords', 'middleware' => 'auth', 'as' => 'passwords.'], function () {
    Route::get('{password}', 'PasswordController@getView')->name('view');
});

