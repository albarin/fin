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

use App\Jobs\ProcessTransactionsDocument;

Route::get('/', function () {
    return view('welcome');
});

Route::post('upload', function () {
    $file = request()->file('document');
    $file->store('documents');

    dispatch(new ProcessTransactionsDocument($file->hashName(), $userId = 1));

    return back();
});