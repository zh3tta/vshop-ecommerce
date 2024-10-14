<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Sunt nisi Lorem ea velit esse qui fugiat.',
            'price' => 19.03,
            'quantity' => 3,
            'category_id' => 1,
            'brand_id' => 1,
            'description' => 'Commodo quis commodo minim quis irure enim minim. Ut sint anim ex sunt enim. Esse aute commodo fugiat sunt do consectetur id. Et sit ut et duis cillum tempor ut in exercitation elit. Veniam ut et culpa Lorem veniam nostrud voluptate.',
        ]);
    }
}
