<?php

namespace App\Filters;

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
            return $builder->where('category_id', $categoryId);
        }

        return $builder;
    }
}