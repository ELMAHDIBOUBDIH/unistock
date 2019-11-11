<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\Invoices::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker = \Faker\Factory::create('fr_FR');

    return [
      'invoice_type' => $faker->randomElement(['type_1','type_2']),
      'reference'    => $faker->randomNumber(2),
      'date'         => $faker->dateTime(),
      'credit'       => $faker->randomFloat(2, 0, 999),

      'created_at'   => $faker->dateTime(),
      'updated_at'   => $faker->dateTime(),
    ];
});
