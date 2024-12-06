<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address1' => $this->faker->streetAddress(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country_code' => $this->faker->countryCode(),
            'type' => $this->faker->word(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
