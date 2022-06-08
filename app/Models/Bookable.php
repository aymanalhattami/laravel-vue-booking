<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookable extends Model
{
    use HasFactory;

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availableFor($from, $to): bool
    {
        return (bool) !$this->bookings()->betweenDates($from, $to)->count();
    }

    public function priceFor($from, $to): array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon($to)) + 1;
        $price = $days * $this->price;
        return [
                'total' => $price,
                'breakdown' => [
                    $this->price => $days
                ]
            ];
    }
}
