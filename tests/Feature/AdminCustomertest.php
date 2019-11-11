<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Customer;



class AdminCustomerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/customers');

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

        $response = $this->actingAs($user)->get('/api/customers');

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
       public function testApiCreate()
    {
        $user = User::find(1);
  
        $response = $this->actingAs($user)->get('/api/customers/create');

        $response->assertStatus(200)
                    ->assertJson([
                        'CustomerGroups' => true
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
                           'first_name'             =>    'client',
                           'last_name'              =>    'boub',
                           'gender'                 =>    'female',
                           'birthday'               =>    '1993-02-26 15:04:45',
                           'tel'                    =>    '+5829341697401',
                           'fax'                    =>    '+1658493470739',
                           'address'                =>    '1 place Margaret Morin\r19219 Leclercq',
                           'email'                  =>    'laure.vallet@joly.xxx',
                           'image'                  =>    'https://lorempixel.com/640/480/?35333',
                           'solde'                  =>    '405.54',
                           'solde_max'              =>    '190.98',
                           'reg_com'                =>    '47yk21rk48ei',
                           'mat_fisc'               =>    '83le35wp50ty',
                           'num_art'                =>    '49gp88bk39ix',
                           'bloque'                 =>    '0',
                           'note'                   =>    'note',
                           'group_id'               =>    '2'
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/customers', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'customer' => true,
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
        $customer = Customer::where('first_name', 'client')->first();

        $response = $this->actingAs($user)->get('/admin/customers/'.$customer->id);

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
        $customer = Customer::where('first_name', 'client')->first();

        $response = $this->actingAs($user)->get('/api/customers/'.$customer->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'customer' => true
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

        $customer = Customer::where('first_name', 'client')->first();

        $response = $this->actingAs($user)->get('/admin/customers/'.$customer->id.'/edit');

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

        $customer = Customer::where('first_name', 'client')->first();

        $response = $this->actingAs($user)->get('/api/customers/'.$customer->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'customer'         => true,
                        'CustomerGroups'  => true
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

        $customer = Customer::where('first_name', 'client')->first();

       
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
                            'id'                    =>    $customer->id,
                            'group_id'               =>   '9',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/customers/'.$customer->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'customer' => true,
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
        $customers = customer::where('last_name', 'boub')->get();

        foreach ($customers as $customer) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/customers/'.$customer->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    } 
}
