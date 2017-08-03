<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'color',
        'category_id',
        'ignore',
    ];

    public function scopeParents($query)
    {
        return $query
            ->where('category_id', '=', null)
            ->orderBy('name');
    }

    public function hasTransactions()
    {
        return $this->transactions->isNotEmpty();
    }

    public function hasBudget()
    {
        return $this->budget->isNotEmpty();
    }

    public function hasChildren()
    {
        return $this->children->isNotEmpty();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function budget()
    {
        return $this->hasMany(Budget::class);
    }
}
