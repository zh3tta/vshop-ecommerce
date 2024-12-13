<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
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

    public function test_order_admin_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/orders');
        
        $response->assertStatus(200);
    }

    public function test_status_order_update(): void
    {
        UserAddress::factory()->create();
        $order = Order::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->put('/admin/orders/update/'. $order->id, [
                'status' => 'Delivered',
            ]);
        
        $response->assertRedirect();
    }
}
