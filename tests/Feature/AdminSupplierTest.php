<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Supplier;

class AdminSupplierTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/suppliers');

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

        $response = $this->actingAs($user)->get('/api/suppliers');

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
                  $data = [
                           'company_name'           =>   'Mathieu Colin SARL',
                           'first_name'             =>    'mahdi',
                           'last_name'              =>    'boub',
                           'gender'                 =>    'female',
                           'birthday'               =>    '1993-02-26 15:04:45',
                           'tel'                    =>    '+5829341697401',
                           'fax'                    =>    '+1658493470739',
                           'address'                =>    '1 place Margaret Morin\r19219 Leclercq',
                           'email'                  =>    'laure.vallet@joly.xx',
                           'image'                  =>    'https://lorempixel.com/640/480/?35333',
                           'solde'                  =>    '405.54',
                           'solde_max'              =>    '190.98',
                           'reg_com'                =>    '47yk21rk48ei',
                           'mat_fisc'               =>    '83le35wp50ty',
                           'num_art'                =>    '49gp88bk39ix',
                           'bloque'                 =>    '0',
                           'note'                   =>    'note',
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/suppliers', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'supplier' => true,
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
        $supplier = Supplier::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/admin/suppliers/'.$supplier->id);

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
        $supplier = Supplier::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/api/suppliers/'.$supplier->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'supplier' => true
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

        $supplier = Supplier::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/admin/suppliers/'.$supplier->id.'/edit');

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

        $supplier = supplier::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/api/suppliers/'.$supplier->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'supplier' => true,
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

        $supplier = Supplier::where('first_name', 'mahdi')->first();

       
            $data = [

                           'company_name'           =>   'Mathieu Colin SARL',
                           'first_name'             =>    'omar',
                           'last_name'              =>    'boub',
                           'gender'                 =>    'female',
                           'birthday'               =>    '1993-02-26',
                           'tel'                    =>    '+5829341697401',
                           'fax'                    =>    '+1658493470739',
                           'address'                =>    '1 place Margaret Morin\r19219 Leclercq',
                           'email'                  =>    'laure.vallet@joly.xx',
                           'image'                  =>    'https://lorempixel.com/640/480/?35333',
                           'solde'                  =>    '405.54',
                           'solde_max'              =>    '190.98',
                           'reg_com'                =>    '47yk21rk48ei',
                           'mat_fisc'               =>    '83le35wp50ty',
                           'num_art'                =>    '49gp88bk39ix',
                           'bloque'                 =>    '0',
                           'note'                   =>    'note',
              'id'           => $supplier->id
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/suppliers/'.$supplier->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'supplier' => true,
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
        $suppliers = Supplier::where('last_name', 'boub')->get();

        foreach ($suppliers as $supplier) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/suppliers/'.$supplier->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    } 
}
                           