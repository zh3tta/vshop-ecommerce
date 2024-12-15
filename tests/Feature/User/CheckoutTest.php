<?php

namespace Tests\Feature\User;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_purchase_order_checkout(): void
    {
        Brand::factory()->create();
        Category::factory()->create();
        $products = Product::factory()->create();
        $user = User::factory()->create();
        $address = UserAddress::factory()->create();
        
        $response = $this->actingAs($user)->post('/checkout/order', [
            'carts' => [
                ['quantity' => 2, 'product_id' => $products->id]
            ],
            'products' => [$products->toArray()],
            'address' => $address->toArray(),
            'total' => $products->price * 2,
        ]);
        $response->assertSessionHasNoErrors();
        
        // Response redirect
        if ($response->isRedirect()) {
            $response->getTargetUrl();
        } else {
            $response->assertStatus(200);
        }
    }
}
