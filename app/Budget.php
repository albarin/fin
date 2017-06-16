<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'category_id',
    ];

    public static function totals($startDate, $endDate, $userId)
    {
        return DB::select('
            select b.id, b.name, b.category_id, b.amount, coalesce(abs(sum(t.amount)), 0) as total
            from budgets as b
            left join transactions as t on t.category_id = b.category_id
            and t.date >= ? and t.date <= ?
            and t.user_id = ?
            group by b.category_id;
        ', [$startDate, $endDate, $userId]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
