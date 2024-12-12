<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
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

    public function test_brand_admin_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/brands');
        
        $response->assertStatus(200);
    }

    public function test_create_brand_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/brands/store', [
            'name' => 'example',
        ]);

        $response->assertRedirect();
    }

    public function test_update_brand_page_is_displayed(): void
    {
        $brand = Brand::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->put('/admin/brands/update/'. $brand->id, [
                'name' => 'update example',
            ]);
        
        $response->assertRedirect();
    }

    public function test_delete_brand_page_is_displayed(): void
    {
        $brand = Brand::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->delete('/admin/brands/destroy/'. $brand->id);

        $response->assertRedirect();
    }
}
