<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\CustomerVersement;

class AdminCustomerVersementTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/customervers');

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

        $response = $this->actingAs($user)->get('/api/customervers');

        $response->assertStatus(200)
                    ->assertJson([
                        'customer_versements' => true
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
  
        $response = $this->actingAs($user)->get('/api/customervers/create');

        $response->assertStatus(200)
                    ->assertJson([
                        'customers'           => true,
                        'payment_modes'       => true,
                        'compte'              => true,
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
                           'n_versement'        =>    '000000012',
                           'date_v'             =>    '2008-07-07',
                           'valide'             =>    '0',
                           'solde'              =>    '128.88',
                           'versement'          =>    '371.81',
                           'reste'              =>    '459.00',
                           'n_cheque'           =>    '89ub59ta60iv',
                           'note'               =>    '1 place Margaret Morin\r19219 Leclercq',
                           'id_compte'          =>    '1',
                           'id_mode'            =>    '1',
                           'ref_id'             =>    '1',
                           'customer_id'        =>    '1',
                          
                  ];
        $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/customervers', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'customer_versement' => true,
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

        $customerversement = CustomerVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/admin/customervers/'.$customerversement->id);

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
        $CustomerVersement = CustomerVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/api/customervers/'.$CustomerVersement->id);

        $response->assertStatus(200)
                    ->assertJson([

                        'customer_versement' => true
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

        $customerversement = CustomerVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/admin/customervers/'.$customerversement->id.'/edit');

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

        $customerversement = CustomerVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/api/customervers/'.$customerversement->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                       
                        'customers'           => true,
                        'payment_modes'       => true,
                        'compte'              => true,
                        'customer_versement'  => true,
                        
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

        $customerversement = CustomerVersement::where('n_versement', '000000012')->first();

       
            $data = [

                           'n_versement'        =>    '000000012',
                           'date_v'             =>    '2008-07-07',
                           'valide'             =>    '1',
                           'solde'              =>    '100',
                           'versement'          =>    '100',
                           'reste'              =>    '0',
                           'n_cheque'           =>    '89ub59ta60iv',
                           'note'               =>    '1 place Margaret Morin eclercq',
                           'id_compte'          =>    '1',
                           'id_mode'            =>    '1',
                           'ref_id'             =>    '1',
                           'customer_id'        =>    '1',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/customervers/'.$customerversement->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'customer_versement' => true,
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

        $customerversements = CustomerVersement::where('n_versement', '000000012')->get();

       
       foreach ($customerversements as $customerversement) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/customervers/'.$customerversement->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

    

          }
    } 
}
