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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/import', 'ImportController@import');
    Route::post('/upload', 'ImportController@upload');
    Route::resource('accounts', 'AccountController');
    Route::resource('categories', 'CategoryController');
    Route::resource('budgets', 'BudgetController');
    Route::resource('transactions', 'TransactionController');
});

Auth::routes();
