<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\CustomerGroup;


class AdminCustomerGroupsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/customergroups');

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

        $response = $this->actingAs($user)->get('/api/customergroups');

        $response->assertStatus(200)
                    ->assertJson([
                        'customergroups' => true
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
                           'name'           =>   'Gros1',
                           'description'             =>    'description',
                  
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/customergroups', $data);

        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'customergroup' => true,
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

        $CustomerGroup = CustomerGroup::where('name', 'Gros1')->first();

       
            $data = [
                           'name'           =>   'Gros1',
                           'description'             =>    'xxxxxxx',
                           
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/customergroups/'.$CustomerGroup->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'customergroup' => true,
                    ]);
    }

     public function testApiDestroy()
    {
        $user = User::find(1);
         $CustomerGroups = CustomerGroup::where('name', 'Gros1')->get();

        foreach ($CustomerGroups as $CustomerGroup) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/customergroups/'.$CustomerGroup->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    } 
}
