<?php

namespace App\Http\Controllers;

use App\Account;
use App\Money\Balance;

class HomeController extends Controller
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
        $accounts = $this->getAccountsWithBalance();
        $totalBalance = $this->balance->total();

        return view('home', compact('accounts', 'totalBalance'));
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
