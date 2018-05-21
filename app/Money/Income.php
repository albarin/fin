<?php

namespace App\Money;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Income
{
    /**
     * Get the total income between the dates
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param int $accountId
     * @return int
     */
    public function income($startDate, $endDate, $accountId)
    {
        $total = DB::table('transactions')
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select(DB::raw('sum(amount) as income'))
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->where('transactions.ignore', false)
            ->where('amount', '>', 0)
            ->where('account_id', $accountId)
            ->where('categories.ignore', false)
            ->value('income');

        return $total ?: 0;
    }

    /**
     * Get the previous month income in cents
     *
     * @return int
     */
    public function lastMonthIncome()
    {
        return $this->income(
            Carbon::today()->subMonth()->startOfMonth(),
            Carbon::today()->subMonth()->endOfMonth()
        );
    }
}
