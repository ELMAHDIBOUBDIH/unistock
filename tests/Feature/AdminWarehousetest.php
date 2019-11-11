<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Warehouse;

class AdminWarehouseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/warehouses');

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

        $response = $this->actingAs($user)->get('/api/warehouses');

        $response->assertStatus(200)
                    ->assertJson([

                        'warehouses' => true
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
                         
                       'name'        =>   'stock',
                       'address'                   =>    'agadir',
                       'note'              =>    'test',
                       

                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/warehouses', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'warehouse' => true,
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

        $Warehouse = Warehouse::where('name', 'stock')->first();

       
            $data = [
                      'name'              =>   'stock',
                      'address'           =>    'Tiznit',
                      'note'              =>    'test',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/warehouses/'.$Warehouse->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'warehouse' => true,
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
        $Warehouse = Warehouse::where('name', 'stock')->first();


       

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/warehouses/'.$Warehouse->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        


    }
}
