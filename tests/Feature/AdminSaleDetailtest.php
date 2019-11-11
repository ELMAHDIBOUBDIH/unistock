<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\SaleDetail;

class AdminSaleDetailTest extends TestCase
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


        $response = $this->actingAs($user)->get('/admin/saledetails/index/'.$data['id']);

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

        $response = $this->actingAs($user)->get('/api/saledetails/index/'.$data['id']);

        $response->assertStatus(200)
                    ->assertJson([
                        'sale_details' => true,
                        'sale' => true,
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
                    'sale_id'                 =>    '1', 
                    'product_id'             =>    '3', 

                  ];

          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/saledetails', $data);

          $response->assertStatus(200)
                    ->assertJson([
                    //    'success' => true,
                     //   'sale_detail' => true,
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

        $saledetail = SaleDetail::where('unit_price','80')->first();

       
            $data = [
                    'unit_price'             =>   '800', 
                    'quantity'               =>    '90', 
                    'tva_rate'               =>    '80.25', 
                    'montant_ttc'            =>    '1000', 
                    'sale_id'                =>    '1', 
                    'product_id'             =>    '3', 
                ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/saledetails/'.$saledetail->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                       'success' => true,
                       'sale_detail' => true,
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
        $saledetails = Saledetail::where('unit_price','800')->get();

        foreach ($saledetails as $saledetail) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/saledetails/'.$saledetail->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    } 
}
