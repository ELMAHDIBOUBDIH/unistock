<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Category;

class AdminCategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/categories');

        $response->assertStatus(200)
                    ->assertViewIs('layouts.admin');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/api/categories');

        $response->assertStatus(200)
                    ->assertJson([
                        'categories' => true,
                        'all_categories' => true,
                    ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiStore()
    {
        $user = User::find(1);

        $parent = Category::inRandomOrder()->first();

        $data = [
            'name' => 'testing123',
            'description' => 'image',
            'parent_id' => $parent->id,
        ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/categories', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'category' => true
                    ]);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShow()
    {
        $user = User::find(1);
        $category = Category::where('name', 'testing123')->first();

        $response = $this->actingAs($user)->get('/admin/categories/'.$category->id);

        $response->assertStatus(200)
                    ->assertViewIs('layouts.admin');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiShow()
    {
        $user = User::find(1);
        $category = Category::where('name', 'testing123')->first();

        $response = $this->actingAs($user)->get('/api/categories/'.$category->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'category' => true,
                        'categories' => true,
                        'all_categories' => true,
                    ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
     public function testEdit()
    {
        $user = User::find(1);

        $category = Category::where('name', 'testing123')->first();

        $response = $this->actingAs($user)->get('/admin/categories/'.$category->id.'/edit');

        $response->assertStatus(200)
                    ->assertViewIs('layouts.admin');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testApiEdit()
    {
        $user = User::find(1);

        $category = Category::where('name', 'testing123')->first();

        $response = $this->actingAs($user)->get('/api/categories/'.$category->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'category' => true,
                        'all_categories' => true,
                    ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
     public function testApiUpdate()
    {
        $user = User::find(1);

        $parent = Category::inRandomOrder()->first();
        $category = Category::where('name', 'testing123')->first();

        $data = [
            'name' => 'testing123',
            'description' => 'image 333',
            'parent_id' => $parent->id,
        ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/categories/'.$category->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'category' => true,
                    ]);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiDestroy()
    {
        $user = User::find(1);
        $categories = Category::where('name', 'testing123')->get();

        foreach ($categories as $category) {

            $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/categories/'.$category->id);
            $response->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                        ]);
        }


    }


}
