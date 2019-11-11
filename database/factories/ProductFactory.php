<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;
use App\Category;
use App\Supplier;
use App\Brand;

$factory->define(App\Product::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker       = \Faker\Factory::create('fr_FR');
    $category_id = Category::inRandomOrder()->first();
    $brand    = Brand::inRandomOrder()->first();
    $supplier_id = \App\Supplier::inRandomOrder()->first()->id;

    return [
     
      'reference'          => $faker->randomNumber(2),
      'designation'        => $faker->bothify('##??##??##??'),
      'code_barre'         => $faker->ean13(),
      'unit'               => $faker->lexify('???'),
      'cond'               => $faker->randomFloat(2, 0, 30),
      'tva'                => $faker->randomFloat(2, 0, 1),
      'product_facturable' => $faker->boolean(),
      'product_perissable' => $faker->boolean(),
      'date_p'             => $faker->dateTime(),
      'alert_p'            => $faker->dateTime(),
      'etat'               => $faker->randomElement(['actif','sommeil']),
      'image'              => $faker->imageUrl(),
      'price_ht'           => $faker->randomFloat(2, 0, 999),
      'price_ttc'          => $faker->randomFloat(2, 0, 999),
      'last_price'         => $faker->randomFloat(2, 0, 999),
      'pmp'                => $faker->randomFloat(2, 0, 999),
      'qnt_initial'        => $faker->randomFloat(2, 0, 999),
      'alert_stock'        => $faker->randomFloat(2, 0, 999),
      'pack'               => $faker->boolean(),
      'qnt_pack'           => $faker->randomFloat(2, 0, 999),
      'price_pack'         => $faker->randomFloat(2, 0, 999),
      'price_unit_pack'    => $faker->randomFloat(2, 0, 999),
      'note'               => $faker->realText(rand(100, 200)),

      'category_id'        => $category_id,
      'supplier_id'        => $supplier_id,
      'brand_id'           => $brand->id,

      'created_at'         => $faker->dateTime(),
      'updated_at'         => $faker->dateTime(),
    ];
});
