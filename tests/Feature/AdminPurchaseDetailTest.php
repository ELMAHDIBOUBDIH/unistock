<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\PurchaseDetail;

class AdminPurchaseDetailTest extends TestCase
{
	  /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $data = [
                    'id'  => "1"
                        
                  ];


        $response = $this->actingAs($user)->get('/admin/purchasedetails/index/'.$data['id']);

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

        $data = [
                    'id'  => "1"
                        
                  ];

        $response = $this->actingAs($user)->get('/api/purchasedetails/index/'.$data['id']);

        $response->assertStatus(200)
                    ->assertJson([
                        'purchase_details' => true,
                        'purchase' => true,
                    ]);
    }
   
/**
     * A basic test example.
     *
  //   * @return void
  */
     public function testApiStore()
    {
        $user = User::find(1);
                  $data = [

                    'unit_price'             =>   '80', 
                    'quantity'               =>    '90', 
                    'tva_rate'               =>    '80.25', 
                    'montant_ttc'            =>    '1000', 
                    'purchase_id'            =>    '1', 
                    'product_id'             =>    '3', 

                  ];

          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/purchasedetails', $data);

          $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'purchase_detail' => true,
                    ]);
    }
     /**
     * A basic test example.
     *
     * @return void
      */
   
          /**
     * A basic test example.
     *
    // * @return void
     */
    public function testApiUpdate()
    {
        $user = User::find(1);

        $purchasedetail = PurchaseDetail::where('unit_price','80')->first();

       
            $data = [
                    'unit_price'             =>   '800', 
                    'quantity'               =>    '90', 
                    'tva_rate'               =>    '80.25', 
                    'montant_ttc'            =>    '1000', 
                    'purchase_id'            =>    '1', 
                    'product_id'             =>    '3', 
                ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/purchasedetails/'.$purchasedetail->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                       'success' => true,
                       'purchase_detail' => true,
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
        $purchasedetails = purchasedetail::where('unit_price','800')->get();

        foreach ($purchasedetails as $purchasedetail) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/purchasedetails/'.$purchasedetail->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    } 
}
                    