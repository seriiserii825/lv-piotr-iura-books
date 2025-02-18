<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author'
    ];

    public function scopeTitle(Builder $query, $title)
    {
        return $query->where('title', 'like', "%$title%");
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
