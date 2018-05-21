<?php

namespace App\Money;

use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Balance
{
    /**
     * Get current total balance
     *
     * @return int
     */
    public function total()
    {
        $total = 0;
        foreach (Account::all() as $account) {
            $total += $this->balanceUntil(Carbon::today()->endOfDay(), $account->id);
        }

        return number_format($total, 2, '.', '');
    }

    /**
     * Get current balance in cents
     *
     * @param $accountId
     * @return int
     */
    public function currentBalance($accountId)
    {
        $balanceUntil = $this->balanceUntil(Carbon::today()->endOfDay(), $accountId);

        return number_format($balanceUntil, 2, '.', '');
    }

    /**
     * Get the previous month balance in cents
     *
     * @param $accountId
     * @return int
     */
    public function lastMonthBalance($accountId)
    {
        return $this->balanceUntil(Carbon::today()->subMonth()->endOfDay(), $accountId);
    }

    /**
     * Get the balance increase percentage between the
     * month of a date and the previous month
     *
     * @param \DateTime $date
     * @param $accountId
     * @return float|int
     */
    public function balanceIncrease(\DateTime $date, $accountId)
    {
        return increase(
            $this->currentBalance($accountId),
            $this->balanceUntil($date, $accountId)
        );
    }

    /**
     * Get the sum of all transactions until a date
     *
     * @param \DateTime $date
     * @param int $accountId
     * @return int
     */
    private function balanceUntil(\DateTime $date, $accountId)
    {
        $initialBalance = Account::find($accountId)->initial_balance;

        $balance = DB::table('transactions')
            ->where('date', '<=', $date)
            ->where('account_id', $accountId)
            ->sum('amount');

        return $initialBalance + $balance;
    }
}
