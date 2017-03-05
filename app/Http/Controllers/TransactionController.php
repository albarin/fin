<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\StoreTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.index', [
            'transactions' => Auth::user()->transactions()->orderBy('date', 'desc')->get(),
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create', [
            'accounts' => Account::pluck('name', 'id'),
        ]);
    }

    /**
     * @param StoreTransaction $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request)
    {
        $transaction = new Transaction($request->all());
        $transaction->user()
            ->associate(Auth::user())
            ->save();

        return redirect()->route('transactions.index');
    }

    /**
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', [
            'accounts' => Account::pluck('name', 'id'),
            'transaction' => $transaction,
        ]);
    }

    /**
     * @param StoreTransaction $request
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTransaction $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return redirect()->route('transactions.index');
    }

    /**
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index');
    }
}
