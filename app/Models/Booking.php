<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'bookable_id'];

    public function bookable()
    {
        return $this->belongsTo(Booking::class);
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
}
