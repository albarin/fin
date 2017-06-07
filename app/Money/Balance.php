<?php

namespace App\Money;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Balance
{
    /**
     * @var int
     */
    private $initialBalance;

    public function __construct($initialBalance)
    {
        $this->initialBalance = $initialBalance;
    }

    /**
     * Get current balance in cents
     *
     * @param $accountId
     * @return int
     */
    public function currentBalance($accountId)
    {
        return $this->balanceUntil(Carbon::today()->endOfDay(), $accountId);
    }

    /**
     * Get the previous month balance in cents
     *
     * @param $accountId
     * @return int
     */
    public function lastMonthBalance($accountId)
    {
        return $this->initialBalance +
            $this->balanceUntil(Carbon::today()->subMonth()->endOfDay(), $accountId);
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
     * @param $accountId
     * @return int
     */
    private function balanceUntil(\DateTime $date, $accountId)
    {
        $balance = DB::table('transactions')
            ->where('date', '<=', $date)
            ->where('account_id', $accountId)
            ->sum('amount');

        return $this->initialBalance + $balance;
    }
}
