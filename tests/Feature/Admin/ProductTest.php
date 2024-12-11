<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    private $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'isAdmin' => 1,
        ]);
    }

    public function test_product_admin_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/products');
        
        $response->assertStatus(200);
    }

    public function test_create_product_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/products/store', [
            'title' => 'example',
            'quantity' => 5,
            'price' => 199,
        ]);

        $response->assertRedirect();
    }

    public function test_published_product_change(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/products/change-published/'. $product->id);

        $response->assertRedirect();
    }

    public function test_update_product_page_is_displayed(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->put('/admin/products/update/'. $product->id, [
                'title' => $product->title,
                'price' => 299,
                'quantity' => $product->quantity,
                'description' => $product->description,
                'category_id' => $product->category_id,
                'brand_id' => $product->brand_id,
            ]);
        
        $response->assertRedirect();
    }

    public function test_delete_product_page_is_displayed(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->delete('/admin/products/destroy/'. $product->id);

        $response->assertRedirect();
    }

    public function test_delete_image_product(): void
    {
        
    }
}
