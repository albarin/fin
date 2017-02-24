<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTransactionsDocument;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function upload()
    {
        $file = request()->file('document');
        $file->store('documents');

        dispatch(new ProcessTransactionsDocument($file->hashName(), $userId = 1));

        return back();
    }
}
