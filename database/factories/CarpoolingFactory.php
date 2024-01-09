<?php

namespace Database\Factories;

use App\Models\Carpooling;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarpoolingFactory extends Factory
{
    protected $model = Carpooling::class;

    public function definition()
    {
        return [
            'seat' => $this->faker->numberBetween(1, 5), // Assuming seats range from 1 to 5
            'status' => $this->faker->randomElement(['available', 'booked', 'cancelled']), // Example statuses
            'codebar' => $this->faker->optional()->ean13, // EAN-13 barcode (or use any other format you require)
            'used' => $this->faker->boolean, // Random boolean value
        ];
    }
}
