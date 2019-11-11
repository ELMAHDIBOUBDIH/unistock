<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Brand;

class AdminBrandTest extends TestCase
{
     /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/brands');

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

        $response = $this->actingAs($user)->get('/api/brands');

        $response->assertStatus(200)
                    ->assertJson([

                        'brands' => true,
                      
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

        $data = [
            'name' => 'testing123',
            'description' => 'image',
            
        ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/brands', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'brand' => true,
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

       
        $brand = Brand::where('name', 'testing123')->first();

        $data = [
            'name' => 'testing123',
            'description' => 'image 333',
           
        ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/brands/'.$brand->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'brand' => true,
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
        $brand = Brand::where('name', 'testing123')->first();

            $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/brands/'.$brand->id);
            $response->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                        ]);
    


    }
}
