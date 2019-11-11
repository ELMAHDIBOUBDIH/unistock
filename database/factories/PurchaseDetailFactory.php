<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\PurchaseDetail::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');
    
    $faker       = \Faker\Factory::create('fr_FR');
    $product_id  = \App\Product::inRandomOrder()->first()->id;
    $purchase_id = \App\Purchase::inRandomOrder()->first()->id;

    return [
      'unit_price'  => $faker->randomFloat(2, 0, 999),
      'quantity'    => $faker->randomFloat(2, 0, 999),
      'tva_rate'    => $faker->randomFloat(2, 0, 999),
      'montant_ttc' => $faker->randomFloat(2, 0, 999),

      'purchase_id' => $purchase_id,
      'product_id'  => $product_id,

      'created_at'  => $faker->dateTime(),
      'updated_at'  => $faker->dateTime(),
    ];
});
