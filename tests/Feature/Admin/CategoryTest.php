<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
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

    public function test_category_admin_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/categories');
        
        $response->assertStatus(200);
    }

    public function test_create_category_page_is_displayed(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/categories/store', [
            'name' => 'example',
        ]);

        $response->assertRedirect();
    }

    public function test_update_category_page_is_displayed(): void
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->put('/admin/categories/update/'. $category->id, [
                'name' => 'update example',
            ]);
        
        $response->assertRedirect();
    }

    public function test_delete_category_page_is_displayed(): void
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->adminUser)
            ->delete('/admin/categories/destroy/'. $category->id);

        $response->assertRedirect();
    }
}
