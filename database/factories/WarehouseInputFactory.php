<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\WarehouseInput::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker        = \Faker\Factory::create('fr_FR');
    $product_id   = \App\Product::inRandomOrder()->first()->id;
    $warehouse_id = \App\Warehouse::inRandomOrder()->first()->id;

    return [
      'type'         => $faker->randomElement(['purchase','internal_movement']),
      'quantity'     => $faker->randomNumber(2),

      'product_id'   => $product_id,
      'warehouse_id' => $warehouse_id,

      'created_at'   => $faker->dateTime(),
      'updated_at'   => $faker->dateTime(),
    ];
});
