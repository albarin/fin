<?php

namespace App\Money;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Savings
{
    /**
     * Get the total savings between the dates
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return int
     */
    public function savings($startDate, $endDate)
    {
        return DB::table('transactions')
            ->select(DB::raw('sum(amount) as savings'))
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
//            ->where('ignore', false)
            ->value('savings');
    }

    /**
     * Get the previous month savings in cents
     *
     * @return int
     */
    public function lastMonthSavings()
    {
        return $this->savings(
            Carbon::today()->subMonth()->startOfMonth(),
            Carbon::today()->subMonth()->endOfMonth()
        );
    }
}
