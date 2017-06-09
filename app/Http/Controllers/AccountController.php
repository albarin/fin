<?php

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Http\Requests\StoreAccount;
use App\Money\Balance;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $balance;

    public function __construct(Balance $balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.index', [
            'accounts' => Auth::user()->accounts,
        ]);
    }

    public function show(Request $request, Account $account)
    {
        $categories = Category::parents()->get();

        if ($dateRange = $request->get('daterange')) {
            $dateRange = explode(' - ', $dateRange);
        }

        $startDate = isset($dateRange[0])
            ? Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay()
            : Carbon::today()->firstOfMonth();

        $endDate = isset($dateRange[1])
            ? Carbon::createFromFormat('d/m/Y', $dateRange[1])->startOfDay()
            : Carbon::today()->endOfMonth();

        $transactions = $account
            ->transactions()
            ->filter($startDate, $endDate, $request->get('category_id'))
            ->orderBy('date', 'desc')
            ->paginate(20);

        $byCategories = Transaction::byCategories($startDate, $endDate, $account->id);

        return view('accounts.show', [
            'account' => $account,
            'transactions' => $transactions,
            'categories' => $categories,
            'startDate' => $startDate->format('d/m/Y'),
            'endDate' => $endDate->format('d/m/Y'),
            'selectedCategoryId' => $request->get('category_id'),
            'balance' => $this->balance->currentBalance($account->id),
            'chart' => $this->getChart($byCategories),
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

    private function getChart(array $categories)
    {
        if (empty($categories)) {
            return [];
        }
        foreach ($categories as $category) {
            $labels[] = $category->cat_name;
            $data[] = (float) $category->absolute;
            $colors[] = $category->color;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'colors' => $colors,
        ];
    }
}
