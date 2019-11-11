<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\SupplierVersement;

class AdminSupplierVersementTest extends TestCase
{
   /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/Suppliervers');

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

        $response = $this->actingAs($user)->get('/api/Suppliervers');

        $response->assertStatus(200)
                    ->assertJson([
                        'Supplier_versements' => true
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
  
        $response = $this->actingAs($user)->get('/api/Suppliervers/create');

        $response->assertStatus(200)
                    ->assertJson([
                        'Suppliers'           => true,
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
                           'date'             =>    '2008-07-07',
                           'valide'             =>    '0',
                           'solde'              =>    '128.88',
                           'versement'          =>    '371.81',
                           'reste'              =>    '459.00',
                           'n_cheque'           =>    '89ub59ta60iv',
                           'note'               =>    '1 place Margaret Morin\r19219 Leclercq',
                           'id_compte'          =>    '1',
                           'id_mode'            =>    '1',
                           'ref_id'             =>    '1',
                           'supplier_id'        =>    '1',
                          
                  ];
        $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/Suppliervers', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'Supplier_versement' => true,
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

        $Supplierversement = SupplierVersement::where('n_versement', '000000012')->first();
        
        $response = $this->actingAs($user)->get('/admin/Suppliervers/'.$Supplierversement->id);

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
        $SupplierVersement = SupplierVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/api/Suppliervers/'.$SupplierVersement->id);

        $response->assertStatus(200)
                    ->assertJson([

                        'Supplier_versement' => true
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

        $Supplierversement = SupplierVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/admin/Suppliervers/'.$Supplierversement->id.'/edit');

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

        $Supplierversement = SupplierVersement::where('n_versement', '000000012')->first();

        $response = $this->actingAs($user)->get('/api/Suppliervers/'.$Supplierversement->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                       
                        'Suppliers'           => true,
                        'payment_modes'       => true,
                        'compte'              => true,
                        'Supplier_versement'  => true,
                        
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

        $Supplierversement = SupplierVersement::where('n_versement', '000000012')->first();

       
            $data = [

                           'n_versement'        =>    '000000012',
                           'date'             =>    '2008-07-07',
                           'valide'             =>    '1',
                           'solde'              =>    '100',
                           'versement'          =>    '100',
                           'reste'              =>    '0',
                           'n_cheque'           =>    '89ub59ta60iv',
                           'note'               =>    '1 place Margaret Morin eclercq',
                           'id_compte'          =>    '1',
                           'id_mode'            =>    '1',
                           'ref_id'             =>    '1',
                           'supplier_id'        =>    '1',
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/Suppliervers/'.$Supplierversement->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'Supplier_versement' => true,
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

        $Supplierversements = SupplierVersement::where('n_versement', '000000012')->get();

       
       foreach ($Supplierversements as $Supplierversement) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/Suppliervers/'.$Supplierversement->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

    

          }
    } 
}
