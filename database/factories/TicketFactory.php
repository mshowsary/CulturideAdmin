<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'seat' => $this->faker->randomNumber(2),
            'codebar' => Str::random(10), 
            'used' => $this->faker->boolean,
        ];
    }
}
