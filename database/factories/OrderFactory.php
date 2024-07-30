<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'beds' => fake()->numberBetween(1, 7),
            'baths' => fake()->numberBetween(1, 7),
            'city' => fake()->city(),
            'code' => fake()->postcode(),
            'street' => fake()->streetAddress(),
            'street_nr' => fake()->numberBetween(10, 200),
            'price' => fake()->numberBetween(100000, 2000000000)
        ];
    }
}
