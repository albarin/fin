<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\ImportTransactions;
use App\Jobs\ProcessTransactionsDocument;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function import()
    {
        $accounts = Auth::user()->accounts;

        return view('import.form', compact('accounts'));
    }

    public function upload(ImportTransactions $request)
    {
        $file = $request->file('document');
        $file->store('documents');
        $accountId = $request->get('account_id');

        dispatch(
            new ProcessTransactionsDocument(
                $file->hashName(),
                $accountId
            )
        );

        return redirect()->route('accounts.show', ['account_id' => $accountId]);
    }
}
