<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\SupplierVersement::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker       = \Faker\Factory::create('fr_FR');
    $supplier_id = \App\Supplier::inRandomOrder()->first()->id;
    $id_mode     = \App\PaymentMode::inRandomOrder()->first()->id;
    $id_compte   = \App\Compte::inRandomOrder()->first()->id;

    return [
      'n_versement' => $faker->bothify('##??##??##??'),
      'n_cheque'    => $faker->bothify('##??##??##??'),
      'date'      => $faker->dateTime(),
      'valide'      => $faker->boolean(),

      'solde'       => $faker->randomFloat(8, 0, 999),
      'versement'   => $faker->randomFloat(8, 0, 999),
      'reste'       => $faker->randomFloat(8, 0, 999),
      'note'        => $faker->realText(rand(100, 200)),

      'supplier_id' => $supplier_id,
      'id_mode'     => $id_mode,
      'id_compte'   => $id_compte,

      'created_at'  => $faker->dateTime(),
      'updated_at'  => $faker->dateTime(),
    ];
});
