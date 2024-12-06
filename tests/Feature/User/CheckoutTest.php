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
        Brand::factory(3)->create();
        Category::factory(4)->create();
        $products = Product::factory(10)->create();
        $user = User::factory()->create();
        $cart = [
            ['quantity' => 3, 'product_id' =>1],
            ['quantity' => 1, 'product_id' =>3],
            ['quantity' => 2, 'product_id' =>5],
        ];
        $address = UserAddress::factory()->create();
        
        $response = $this->actingAs($user)->post('/checkout/order', [
            'carts' => $cart,
            'products' => $products,
            'address' => $address,
            'total' => 1999.00,
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
