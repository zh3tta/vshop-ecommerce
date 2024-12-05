<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'quantity' => $this->faker->numberBetween(1, 999),
            'description' => $this->faker->text(200),
            'published' => $this->faker->randomElement(['0', '1']),
            'inStock' => $this->faker->randomElement(['0', '1']),
            'price' => $this->faker->numberBetween(1, 1000),
            'brand_id' => Brand::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }
}
