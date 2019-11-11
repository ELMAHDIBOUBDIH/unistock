<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\WarehouseProduct;

class AdminWarehouseProductsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/warehouseproducts');

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

        $response = $this->actingAs($user)->get('/api/warehouseproducts');

        $response->assertStatus(200)
                    ->assertJson([
                        'warehouse_products' => true
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

                     'warehouse_id'                  =>    '1',
                     'product_id'                    =>    '1',
                     'quantity'                      =>    '6.03',
                     'quantity_reserved'             =>    '6.03',
                     'zone'                          =>    'yyy',
                     'shelf'                         =>    'yyy',
                     'note'                          =>    'yyy',
                     
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/warehouseproducts', $data);

        $response->assertStatus(200)
                    ->assertJson([
                       'success' => true,
                        'warehouse_product' => true,
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

        $WarehouseProduct = WarehouseProduct::where('product_id', '1')->first();

       
            $data = [
                     'warehouse_id'                  =>    '1',
                     'product_id'                    =>    '1',
                     'quantity'                      =>    '6.03',
                     'quantity_reserved'             =>    '6.03',
                     'zone'                          =>    'A',
                     'shelf'                         =>    'S',
                     'note'                          =>    'xxx',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/warehouseproducts/'.$WarehouseProduct->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'warehouse_product' => true,
                    ]);
    }

}
