<?php

namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each(function($bookable){
            $booking = Booking::factory()->make();
            $bookings = collect([$booking]);

            for($i = 0; $i < random_int(1, 20); $i++){
                $from = (clone $booking->to)->addDays(random_int(1, 14));
                $to = (clone $from)->addDays(random_int(0, 14));

                $booking = Booking::create([
                    'from' => $from,
                    'to' => $to,
                    'bookable_id' => Bookable::inRandomOrder()->first()->id
                ]);

                $bookings->push($booking);
            }

            $bookable->bookings()->saveMany($bookings);
        });
    }
}
