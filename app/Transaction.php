<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        'account_id',
        'category_id',
    ];

    protected $dates = ['date'];

    public function getDateAttribute($date)
    {
        return date('d/m/Y', strtotime($date));
    }

    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $date)->startOfDay();
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->attributes['amount'], 2, '.', '');
    }

    public function getColorAttribute()
    {
        return $this->attributes['amount'] < 0
            ? 'darkred'
            : 'green';
    }

    public function scopeFilter($query, $startDate, $endDate, $categoryId = null)
    {
        $query->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate);

        if (!empty($categoryId)) {
            $query->whereIn('category_id', $this->getSubcategories($categoryId));
        }

        return $query->orderBy('date', 'desc');
    }

    public static function byCategories($startDate, $endDate, $accountId)
    {
        return DB::select('
            select 
                case when c.category_id is null then c.id
                else c.category_id end as cat_id,
                (select cc.name from categories as cc where cc.id=cat_id) as cat_name,
                (select cc.color from categories as cc where cc.id = cat_id) as color,
                sum(t.amount) as total,
                abs(sum(t.amount)) as absolute
            from categories as c
            left join transactions as t on t.category_id = c.id and t.date >= ? and t.date <= ? and t.account_id = ?
            group by cat_id
            having total <= 0 || total is null
            order by absolute desc
        ', [$startDate, $endDate, $accountId]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function originAccount()
    {
        return $this->belongsTo(Account::class, 'origin_account_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    private function getSubcategories($categoryId)
    {
        $subcategories = Category::where('category_id', $categoryId)
            ->pluck('id')
            ->toArray();

        $subcategories[] = $categoryId;

        return $subcategories;
    }
}
