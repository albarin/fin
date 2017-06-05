<?php

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Filters\TransactionFilters;
use App\Http\Requests\StoreAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function show(Request $request, Account $account, TransactionFilters $filters)
    {
        $transactions = $account
            ->transactions()
            ->filter($filters)
            ->orderBy('date', 'desc')
            ->paginate(20);

        $categories = Category::parents()->get();

        if ($dateRange = $request->get('daterange')) {
            $dateRange = explode(' - ', $dateRange);
        }

        return view('accounts.show', [
            'account' => $account,
            'transactions' => $transactions,
            'categories' => $categories,
            'startDate' => isset($dateRange[0])
                ? $dateRange[0]
                : Carbon::today()->firstOfMonth()->format('d/m/Y'),
            'endDate' => isset($dateRange[1])
                ? $dateRange[1]
                : Carbon::today()->endOfMonth()->format('d/m/Y'),
            'selectedCategoryId' => $request->get('category_id'),
        ]);
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
