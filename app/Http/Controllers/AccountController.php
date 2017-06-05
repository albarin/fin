<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\StoreAccount;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.index', [
            'accounts' => Auth::user()->accounts,
        ]);
    }

    public function show(Account $account)
    {
        $transactions = $account
            ->transactions()
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('accounts.show', compact('account', 'transactions'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * @param StoreAccount $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccount $request)
    {
        $account = new Account($request->all());
        $account->user()
            ->associate(Auth::user())
            ->save();

        return redirect()->route('accounts.show', [$account]);
    }

    /**
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * @param StoreAccount $request
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAccount $request, Account $account)
    {
        $account->update($request->all());

        return redirect()->route('accounts.index');
    }

    /**
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if (!$account->transactions->isEmpty()) {
            return redirect()
                ->route('accounts.index')
                ->with('error', 'Cannot delete account with transactions');
        }

        $account->delete();

        return redirect()->back();
    }
}
