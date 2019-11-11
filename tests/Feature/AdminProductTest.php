<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Product;

class AdminProductTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/products');

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

        $response = $this->actingAs($user)->get('/api/products');

        $response->assertStatus(200)
                    ->assertJson([
                        'products' => true
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
                  'brand'                  =>   'Grondin', 
                  'reference'              =>    '15', 
                  'designation'            =>    'TPLINK', 
                  'code_barre'             =>    '6681062608157', 
                  'unit'                   =>    'lws', 
                  'cond'                   =>    '19.15', 
                  'tva'                    =>    '0.71', 
                  'product_facturable'     =>    '0', 
                  'product_perissable'     =>    '1', 
                  'date_p'                 =>    '2011-12-31 10:44:25', 
                  'alert_p'                =>    '2011-12-31 10:44:25', 
                  'etat'                   =>    'sommeil', 
                  'image'                  =>    'https://lorempixel.com/640/480/?81335',
                  'price_ht'               =>    '887.72', 
                  'price_ttc'              =>    '975.83', 
                  'last_price'             =>    '145.20', 
                  'pmp'                    =>    '804.82', 
                  'qnt_initial'            =>    '439.66', 
                  'alert_stock'            =>    '787.91', 
                  'pack'                   =>    '0', 
                  'qnt_pack'               =>    '828.36', 
                  'price_pack'             =>    '937.11', 
                  'price_unit_pack'        =>    '657.73', 
                  'note'                   =>    'Sur la fosse', 
                  'category_id'            =>    '3', 
                  'supplier_id'            =>    '5'
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/products', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'product' => true,
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
        $product = Product::where('designation', 'TPLINK')->first();

        $response = $this->actingAs($user)->get('/admin/products/'.$product->id);

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
        $Product = Product::where('designation', 'TPLINK')->first();

        $response = $this->actingAs($user)->get('/api/products/'.$Product->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'product' => true
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

        $product = Product::where('designation', 'TPLINK')->first();

        $response = $this->actingAs($user)->get('/admin/products/'.$product->id.'/edit');

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

        $product = Product::where('designation', 'TPLINK')->first();

        $response = $this->actingAs($user)->get('/api/products/'.$product->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'product' => true,
                        'categories' => true,
                        'suppliers' => true
                    ]);
    }
         /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/products/create');

        $response->assertStatus(200)
                    ->assertViewIs('layouts.admin');
    }
/**
     * A basic test example.
     *
     * @return void
     */
    public function testApiCreate()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/api/products/create');

        $response->assertStatus(200)
                    ->assertJson([
                        'categories' => true,
                        'suppliers' => true,
                        'CustomerGroup' => true,
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

        $product = Product::where('designation', 'TPLINK')->first();

       
            $data = [
                  'brand'                  =>   'TPLINK', 
                  'reference'              =>    '000001', 
                  'designation'            =>    'TPLINK', 
                  'code_barre'             =>    '6681062608157', 
                  'unit'                   =>    'lws', 
                  'cond'                   =>    '19.15', 
                  'tva'                    =>    '0.71', 
                  'product_facturable'     =>    '0', 
                  'product_perissable'     =>    '1', 
                  'date_p'                 =>    '2011-12-31 10:44:25', 
                  'alert_p'                =>    '2011-12-31 10:44:25', 
                  'etat'                   =>    'sommeil', 
                  'image'                  =>    'https://lorempixel.com/640/480/?81335',  
                  'price_ht'               =>    '887.72', 
                  'price_ttc'              =>    '975.83', 
                  'last_price'             =>    '145.20', 
                  'pmp'                    =>    '804.82', 
                  'qnt_initial'            =>    '439.66', 
                  'alert_stock'            =>    '787.91', 
                  'pack'                   =>    '0', 
                  'qnt_pack'               =>    '828.36', 
                  'price_pack'             =>    '937.11', 
                  'price_unit_pack'        =>    '657.73', 
                  'note'                   =>    'Sur la fosse', 
                  'category_id'            =>    '3', 
                  'supplier_id'            =>    '5',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/products/'.$product->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'product' => true,
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
        $products = Product::where('designation', 'TPLINK')->get();

        foreach ($products as $product) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/products/'.$product->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    }
}
                  