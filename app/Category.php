<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'color',
        'category_id'
    ];

    public function scopeParents($query)
    {
        return $query->where('category_id', '=', null)->orderBy('name');
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
