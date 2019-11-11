<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\Sale::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker       = \Faker\Factory::create('fr_FR');
    $ref = \App\Sale::inRandomOrder()->first();
    $employee_id  = \App\Employee::inRandomOrder()->first()->id;
    $customer_id = \App\Customer::inRandomOrder()->first()->id;

     if ($ref) {
        $ref_id = $ref->id;
    } else {
        $ref_id = null;
    }

    return [
      'sale_number' => $faker->bothify('##??##??##??'),
      'date'   => $faker->dateTime(),
      'type'        => $faker->randomElement(['DV','BC','BL']),
      'total_tva'   => $faker->randomFloat(2, 0, 999),
      'total_ht'    => $faker->randomFloat(2, 0, 999),
      'total_ttc'   => $faker->randomFloat(2, 0, 999),


      'remise'      => $faker->randomFloat(2, 0, 999),
      'note'        => $faker->realText(rand(100, 200)),

      'ref_id'      => $ref_id,
      'customer_id' => $customer_id,
      'employee_id' => $employee_id,

      'created_at'  => $faker->dateTime(),
      'updated_at'  => $faker->dateTime(),
    ];
});
