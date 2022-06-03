<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'bookable_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($booking){
            $booking->review_key = Str::uuid();
        });
    }

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    /**
     * check for dates overlaps
     *
     * @param Builder $query
     * @param date $from
     * @param date $to
     *
     * @return void
     */
    public function scopeBetweenDates($query, $from, $to)
    {
        $query->where('to', '>=', $from)->where('from', '<=', $to);
    }

    public static function findByReviewKey(string $reviewKey) : ?Booking # return Booking or null
    {
        return static::where('review_key', $reviewKey)->with('bookable')->get()->first();
    }
}
