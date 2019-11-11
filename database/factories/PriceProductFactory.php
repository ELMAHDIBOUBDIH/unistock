<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\PriceProduct::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker      = \Faker\Factory::create('fr_FR');
    $group_id   = \App\CustomerGroup::inRandomOrder()->first()->id;
    $product_id = \App\Product::inRandomOrder()->first()->id;

    return [
      'marge'       => $faker->randomFloat(2, 0, 9),
      'montant_ht'  => $faker->randomFloat(2, 0, 9),
      'montant_ttc' => $faker->randomFloat(2, 0, 9),

      'group_id'    => $group_id,
      'product_id'  => $product_id,

      'created_at'  => $faker->dateTime(),
      'updated_at'  => $faker->dateTime(),
    ];
});
