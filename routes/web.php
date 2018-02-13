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

Route::get('/', 'CompanyController@getRedirect');
Route::get('profile', 'ProfileController@getUpdate')->name('profile.update');
Route::post('profile', 'ProfileController@postUpdate');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

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
    Route::get('add/{company}', 'PasswordController@getAdd')->name('add');
    Route::post('add/{company}', 'PasswordController@postAdd')->name('add');
    Route::get('{password}', 'PasswordController@getView')->name('view');
    Route::get('{password}/decrypt', 'PasswordController@getDecrypt')->name('decrypt');
    Route::get('{password}/update', 'PasswordController@getUpdate')->name('update');
    Route::post('{password}/update', 'PasswordController@postUpdate')->name('update');
});

Route::group(['prefix' => 'monitoring', 'as' => 'monitoring.'], function () {
    Route::get('nagios', 'MonitoringController@getNagios')->name('nagios');
});
