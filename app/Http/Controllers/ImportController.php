<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTransactionsDocument;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function import()
    {
        return view('import.form');
    }

    public function upload()
    {
        $file = request()->file('document');
        $file->store('documents');

        dispatch(
            new ProcessTransactionsDocument(
                $file->hashName(),
                Auth::user()->accounts->first()->id
            )
        );

        return back();
    }
}
