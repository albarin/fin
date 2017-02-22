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

use App\Document;
use App\Jobs\ProcessTransactionsDocument;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('document', function () {
    $doc = new Document(['filename' => 'lacaixa.csv']);
    $doc->user()->associate(User::first())->save();

    dispatch(
        (new ProcessTransactionsDocument($doc))
    );

    dd($doc);
});

Route::post('upload', function () {
    request()->file('document')->store('documents');

    return back();
});