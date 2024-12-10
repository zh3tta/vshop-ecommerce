<?php

namespace Tests\Feature\User;

use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_view_is_displayed(): void
    {
        Brand::factory(3)->create();
        Category::factory(2)->create();
        Product::factory(5)->create();
        $user = User::factory()->create();
        UserAddress::factory()->create();
        CartItem::factory()->create();

        $response = $this->get('/cart/view', [
            'user' => $user,
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_add_product_to_cart(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->post('/cart/store/'. $product->id);

        $response->assertRedirect();
    }

    public function test_update_product_to_cart(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $user = User::factory()->create();
        CartItem::factory()->create();

        $this->actingAs($user);
        $response = $this->patch('/cart/update/'. $product->id, [
            'quantity' => '2',
        ]);

        $response->assertRedirect();
    }

    public function test_remove_product_of_cart(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $product = Product::factory()->create();
        $user = User::factory()->create();
        CartItem::factory()->create();

        $this->actingAs($user);
        $response = $this->delete('/cart/delete/'. $product->id);

        $response->assertRedirect();
    }
}
