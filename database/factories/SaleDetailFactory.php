<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\SaleDetail::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');
    
    $faker      = \Faker\Factory::create('fr_FR');
    $product_id = \App\Product::inRandomOrder()->first()->id;
    $sale_id    = \App\Sale::inRandomOrder()->first()->id;

    return [
      'unit_price'  => $faker->randomFloat(2, 0, 999),
      'quantity'    => $faker->randomFloat(2, 0, 999),
      'tva_rate'    => $faker->randomFloat(2, 0, 999),
      'montant_ttc' => $faker->randomFloat(2, 0, 999),

      'product_id'  => $product_id,
      'sale_id'     => $sale_id,

      'created_at'  => $faker->dateTime(),
      'updated_at'  => $faker->dateTime(),
    ];
});
