<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        return number_format($this->attributes['amount'], 2);
    }

    public function getColorAttribute()
    {
        return $this->attributes['amount'] < 0
            ? 'darkred'
            : 'green';
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
}
