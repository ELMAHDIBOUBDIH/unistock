<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Purchase;

class AdminPurchaseTest extends TestCase
{
     /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/purchases');

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

        $response = $this->actingAs($user)->get('/api/purchases');

        $response->assertStatus(200)
                    ->assertJson([
                        'purchases' => true
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

        $response = $this->actingAs($user)->get('/api/purchases/create');

        $response->assertStatus(200)
                    ->assertJson([
                        'suppliers' => true
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
        $ref = Purchase::inRandomOrder()->first();
                  $data = [

                    'purchase_number'        =>   '555-555-555',
                    'date'                   =>    '2018-08-08',
                    'total_tva'              =>    '10.80',
                    'total_ht'               =>    '193.47',
                    'total_ttc'              =>    '873.26',
                    'type'                   =>     'BC',
                    'ref_id'                 =>     $ref->id,
                    'remise'                 =>    '94.52',
                    'valide'                 =>    '1',
                    'note'                   =>    'note',
                    'supplier_id'            =>    '3',
                    'employee_id'            =>    '3',

                  ];


        $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/purchases', $data);

        $response->assertStatus(200)
                    ->assertJson([
                      //  'success' => true,
                      //  'purchase' => true,
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
        $purchase = Purchase::where('purchase_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/admin/purchases/'.$purchase->id);

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
        $purchase = Purchase::where('purchase_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/api/purchases/'.$purchase->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'purchase' => true
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

        $purchase = purchase::where('purchase_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/admin/purchases/'.$purchase->id.'/edit');

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

        $purchase = purchase::where('purchase_number', '555-555-555')->first();

        $response = $this->actingAs($user)->get('/api/purchases/'.$purchase->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'purchase'         => true,
                        'suppliers'        => true
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
        $ref = Purchase::inRandomOrder()->first();

        $purchase = purchase::where('purchase_number', '555-555-555')->first();


            $data = [

                       'purchase_number'            =>   '555-555-555',
                       'date'                   =>    '2018-08-08',
                       'total_tva'              =>    '10.80',
                       'total_ht'               =>    '193.47',
                       'total_ttc'              =>    '873.26',
                       'type'                   =>     'BC',
                       'ref_id'                 =>     $ref->id,
                       'remise'                 =>    '94.52',
                       'valide'                 =>    '1',
                       'note'                   =>    'note',
                       'supplier_id'            =>    '3',
                       'employee_id'            =>    '3',

                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/purchases/'.$purchase->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'purchase' => true,
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
        $purchases = Purchase::where('purchase_number', '555-555-555')->get();

        foreach ($purchases as $purchase) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/purchases/'.$purchase->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    }
}
