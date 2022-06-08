<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class BookableFactory extends Factory
{
    private $suffix = [
        'Villa',
        'House',
        'Cottage',
        'Luxury Villas',
        'Cheap House',
        'Rooms',
        'Cheap Rooms',
        'Luxury Rooms',
        'Fancy Room'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->city() . ' ' . Arr::random($this->suffix),
            'description' => $this->faker->text(),
            'price' => random_int(15, 600)
        ];
    }
}
