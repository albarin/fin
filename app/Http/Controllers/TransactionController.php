<?php

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Http\Requests\StoreTransaction;
use App\Tag;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('transactions.create', [
            'selectedAccountId' => $request->get('account_id'),
            'accounts' => Account::pluck('name', 'id'),
            'categories' => Category::parents()->get(),
            'tags' => Tag::all(),
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
        $transaction->tags()->sync(
            collect($request->tag_ids)->filter()->all()
        );

        return redirect()->route('accounts.show', [$transaction->account]);
    }

    /**
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', [
            'accounts' => Account::pluck('name', 'id'),
            'categories' => Category::parents()->get(),
            'tags' => Tag::all(),
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
        $data = $request->all();
        $data['ignore'] = $request->has('ignore');

        $transaction->tags()->sync(
            collect($request->tag_ids)->filter()->all()
        );
        $transaction->update($data);

        return redirect()->route('accounts.show', [$transaction->account]);
    }

    /**
     * @param  \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->tags()->detach();
        $transaction->delete();

        return redirect()->back();
    }
}
