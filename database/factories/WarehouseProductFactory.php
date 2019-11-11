<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\WarehouseProduct::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker      = \Faker\Factory::create('fr_FR');
    $product_id = \App\Product::inRandomOrder()->first()->id;

    return [
      'quantity'          => $faker->randomFloat(2, 0, 999),
      'quantity_reserved' => $faker->randomFloat(2, 0, 999),
      'zone'              => $faker->randomElement(['zone_A','zone_B']),
      'shelf'             => $faker->randomElement(['shelf_A','shelf_B','shelf_C','shelf_D','shelf_F','shelf_H']),
      'note'              => $faker->realText(rand(100, 200)),

      'product_id'        => $product_id,

      'created_at'        => $faker->dateTime(),
      'updated_at'        => $faker->dateTime(),
    ];
});
