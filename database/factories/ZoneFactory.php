<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'seat' => $this->faker->numberBetween(10, 200),
            'sold_seat' => $this->faker->numberBetween(0, 200),
            'price' => $this->faker->randomFloat(2, 10, 500), // This generates a random float with 2 decimal points between 10 and 500
        ];
    }
}
