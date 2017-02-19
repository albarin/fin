<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'amount',
    ];

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
