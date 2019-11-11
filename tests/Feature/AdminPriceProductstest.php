<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\PriceProduct;

class AdminPriceProductsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/priceproducts');

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

        $response = $this->actingAs($user)->get('/api/priceproducts');

        $response->assertStatus(200)
                    ->assertJson([
                        'price_products' => true
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

                     'marge'                  =>    '0.1',
                     'montant_ht'             =>    '6.03',
                     'montant_ttc'            =>    '6.03',
                     'product_id'             =>    '1',
                     'group_id'               =>    '1',
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/priceproducts', $data);

        $response->assertStatus(200)
                    ->assertJson([
                       // 'success' => true,
                       // 'price_product' => true,
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

        $PriceProduct = PriceProduct::where('product_id', '1')->first();

       
            $data = [
                     'marge'                  =>    '0.1',
                     'montant_ht'             =>    '6.03',
                     'montant_ttc'            =>    '6.03',
                     'product_id'             =>    '1',
                     'group_id'               =>    '1',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/priceproducts/'.$PriceProduct->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'price_product' => true,
                    ]);
    }

}
