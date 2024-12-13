<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
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
            'total_price' => $this->faker->numberBetween(10, 1999),
            'status' => $this->faker->randomElement(['Unpaid', 'Paid']),
            'session_id' => $this->faker->uuid(),
            'user_address_id' => UserAddress::all()->random()->id,
        ];
    }
}
