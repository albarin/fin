<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'initial_balance',
    ];

    public function getFormattedBalanceAttribute()
    {
        return number_format($this->attributes['initial_balance'], 2, '.', '');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
