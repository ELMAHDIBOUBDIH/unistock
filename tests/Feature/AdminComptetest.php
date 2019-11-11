<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Compte;

class AdminCompteTest extends TestCase
{
     /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/comptes');

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

        $response = $this->actingAs($user)->get('/api/comptes');

        $response->assertStatus(200)
                    ->assertJson([

                        'comptes' => true,
                      
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
            'num' => '2018',
            'name' => 'compte22',
            'nature' => 'caisse',
            'solde_init' => '12032122'            
        ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/comptes', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'compte' => true,
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

       
        $compte = Compte::where('name', 'compte22')->first();

        $data = [
            'num' => '2019',
            'name' => 'compte22',
            'nature' => 'caisse',
            'solde_init' => '12032122'  
           
        ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/comptes/'.$compte->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'compte' => true,
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
        $compte = Compte::where('name', 'compte22')->first();

            $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/comptes/'.$compte->id);
            $response->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                        ]);
    


    }
}
