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
     * @return int
     */
    public function income($startDate, $endDate)
    {
        return DB::table('transactions')
            ->select(DB::raw('sum(amount) as income'))
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->where('ignore', false)
            ->where('amount', '>', 0)
            ->value('income');
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
