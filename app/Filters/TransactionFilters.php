<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionFilters
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        if ($categoryId = $this->request->category_id) {
            $builder->where('category_id', $categoryId);
        }

        if ($dateRange = $this->request->daterange) {
            list($startDate, $endDate) = $this->getDates($dateRange);

            $builder
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate);
        }

        return $builder;
    }

    private function getDates($dateRange = null)
    {
        if (is_null($dateRange)) {
            return [
                Carbon::today()->firstOfMonth(),
                Carbon::today()->endOfMonth(),
            ];
        }

        $dateRange = explode(' - ', $dateRange);
        return [
            Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay(),
            Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay(),
        ];
    }
}