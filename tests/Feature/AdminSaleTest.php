<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Sale;

class AdminSaleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    } public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/sales');

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

        $response = $this->actingAs($user)->get('/api/sales');

        $response->assertStatus(200)
                    ->assertJson([
                        'sales' => true
                    ]);
    }
     /**
     * A basic test example.
     *
     * @return void
     */
       public function testApiCreate()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/api/sales/create');

        $response->assertStatus(200)
                    ->assertJson([
                        'customers' => true
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
        $ref = Sale::inRandomOrder()->first();
                  $data = [

                       'sale_number'            =>   '555-555-555',
                       'date'                   =>    '2018-08-08',
                       'total_tva'              =>    '10.80',
                       'total_ht'               =>    '193.47',
                       'total_ttc'              =>    '873.26',
                       'type'                   =>     'BC',
                       'ref_id'                 =>     $ref->id,
                       'remise'                 =>    '94.52',
                       'valide'                 =>    '1',
                       'note'                   =>    'note',
                       'customer_id'            =>    '3',
                       'employee_id'            =>    '3',

                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/sales', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'sale' => true,
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
        $sale = sale::where('sale_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/admin/sales/'.$sale->id);

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
        $sale = sale::where('sale_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/api/sales/'.$sale->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'sale' => true
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

        $sale = sale::where('sale_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/admin/sales/'.$sale->id.'/edit');

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

        $sale = sale::where('sale_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/api/sales/'.$sale->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'sale'         => true,
                        'customers'        => true
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
        $ref = Sale::inRandomOrder()->first();
        $sale = Sale::where('sale_number', '555-555-555')->first();


            $data = [

                       'sale_number'            =>   '555-555-555',
                       'date'                   =>    '2018-08-08',
                       'total_tva'              =>    '14.80',
                       'total_ht'               =>    '193.47',
                       'total_ttc'              =>    '873.26',
                       'type'                   =>     'BC',
                       'ref_id'                 =>     $ref->id,
                       'remise'                 =>    '94.52',
                       'valide'                 =>    '1',
                       'note'                   =>    'note',
                       'customer_id'            =>    '3',
                       'employee_id'            =>    '3',

                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/sales/'.$sale->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'sale' => true,
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
        $sales = sale::where('sale_number', '555-555-555')->get();

        foreach ($sales as $sale) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/sales/'.$sale->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    }
}
