<?php

namespace App\Http\Controllers;

use App\Account;
use App\Money\Balance;
use App\Money\Expenses;

class HomeController extends Controller
{
    private $balance;
    private $expenses;

    public function __construct(Balance $balance, Expenses $expenses)
    {
        $this->balance = $balance;
        $this->expenses = $expenses;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = $this->getAccountsWithBalance();
        $totalBalance = $this->balance->total();
        $lastYearExpenses = $this->expenses->lastYearExpenses(1);

        return view('home', compact('accounts', 'totalBalance', 'lastYearExpenses'));
    }

    private function getAccountsWithBalance()
    {
        $accounts = Account::all();
        foreach ($accounts as $key => $account) {
            $accounts[$key]->total = $this->balance->currentBalance($account->id);
        }

        return $accounts;
    }
}
