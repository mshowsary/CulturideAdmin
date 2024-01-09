<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->optional()->text,
            'link_facebook' => $this->faker->optional()->url,
            'link_twitter' => $this->faker->optional()->url,
            'link_insta' => $this->faker->optional()->url,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
