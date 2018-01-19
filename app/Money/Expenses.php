<?php

namespace App\Money;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Expenses
{
    /**
     * Get the total expenses between the dates
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param int $accountId
     * @return int
     */
    public function expenses($startDate, $endDate, $accountId)
    {
        $expenses = DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(DB::raw('sum(amount) as expenses'))
            ->where('transactions.date', '>=', $startDate)
            ->where('transactions.date', '<=', $endDate)
            ->where('transactions.ignore', false)
            ->where('transactions.amount', '<', 0)
            ->where('transactions.account_id', $accountId)
            ->where('categories.ignore', false)
            ->value('expenses');

        return abs($expenses);
    }

    /**
     * Get the previous month expenses in cents
     *
     * @return int
     */
    public function lastMonthExpenses()
    {
        return $this->expenses(
            Carbon::today()->subMonth()->startOfMonth(),
            Carbon::today()->subMonth()->endOfMonth()
        );
    }
}
