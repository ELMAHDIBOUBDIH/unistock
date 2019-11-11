<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Employee;


class AdminEmployeeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/admin/employees');

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

        $response = $this->actingAs($user)->get('/api/employees');

        $response->assertStatus(200)
                    ->assertJson([
                        'employees' => true
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
                           'qualification'          =>    'salarie',
                           'recruitment_date'       =>    '1993-02-26',
                           'password'               =>    '123456789',
                           'note'                   =>    'note',
                          
                  ];
                          $response = $this->actingAs($user)->withoutMiddleware()->json('POST', '/api/employees', $data);

        $response->assertStatus(200)
                    ->assertJson([
                       'success' => true,
                       'employee' => true,
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
        $employee = Employee::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/admin/employees/'.$employee->id);

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
        $employee = Employee::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/api/employees/'.$employee->id);

        $response->assertStatus(200)
                    ->assertJson([
                        'employee' => true
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

        $employee = Employee::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/admin/employees/'.$employee->id.'/edit');

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

        $employee = Employee::where('first_name', 'mahdi')->first();

        $response = $this->actingAs($user)->get('/api/employees/'.$employee->id.'/edit');

        $response->assertStatus(200)
                    ->assertJson([
                        'employee' => true,
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

        $employee = Employee::where('first_name', 'mahdi')->first();

       
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
                           'qualification'          =>    'salarie',
                           'recruitment_date'       =>    '1993-02-26',
                           'password'               =>    '123456789',
                           'note'                   =>    'note',
                           'id'                     =>    $employee->id
                  ];

        $response = $this->actingAs($user)->withoutMiddleware()->json('PUT', '/api/employees/'.$employee->id, $data);
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'employee' => true,
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
        $employees = Employee::where('last_name', 'boub')->get();

        foreach ($employees as $employee) {

        $response = $this->actingAs($user)->withoutMiddleware()->json('DELETE', '/api/employees/'.$employee->id);
            $response->assertStatus(200)
            ->assertJson([
                'success' => true
                 ]);

        }


    } 
}
