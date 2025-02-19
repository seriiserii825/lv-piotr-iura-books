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

    public function scopePopular(Builder $query, $from = null, $to = null)
    {
        return $query->withCount(
            ['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)]
        )->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null)
    {
        return $query->withAvg(
            ['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)],
            'rating'
        )->orderBy('reviews_avg_rating', 'desc');
    }

    private function dateRangeFilter(Builder $q, $from, $to)
    {
        if ($from && !$to) {
            $q->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $q->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $q->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopeMinReviews(Builder $query, $count)
    {
        return $query->withCount('reviews')->having('reviews_count', '>=', $count);
    }
}
