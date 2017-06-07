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
     * @return int
     */
    public function expenses($startDate, $endDate)
    {
        $expenses = DB::table('transactions')
            ->select(DB::raw('sum(amount) as expenses'))
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
//            ->where('ignore', false)
            ->where('amount', '<', 0)
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
