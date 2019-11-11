<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\Compte::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');

    $faker = \Faker\Factory::create('fr_FR');

    return [
        'num'        => $faker->numerify('######'),
        'name'       => $faker->word(),
        'nature'     => $faker->randomElement(['caisse','banque']),
        'solde_init' => $faker->randomFloat(2, 0, 999),

        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
