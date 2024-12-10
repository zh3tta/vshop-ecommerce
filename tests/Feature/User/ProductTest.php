<?php

namespace Tests\Feature\User;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_show_product_list(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_show_detail_of_product(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();

        $response = $this->get('/products/detail/'. $product);

        $response->assertStatus(200);
    }
}
