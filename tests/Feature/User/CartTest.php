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
        Category::factory(4)->create();
        Product::factory(10)->create();
        $user = User::factory()->create();
        UserAddress::factory()->create();
        CartItem::factory()->create();

        $response = $this->get('/cart/view', [
            'user' => $user,
        ]);

        $response->assertRedirect(route('home'));
    }
}
