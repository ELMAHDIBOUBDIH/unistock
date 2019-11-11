<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\CustomerGroup::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');
    
    $faker = \Faker\Factory::create('fr_FR');

    return [
      'name'        => $faker->word(),
      'description' => $faker->realText(rand(100, 200)),

      'created_at'  => $faker->dateTime(),
      'updated_at'  => $faker->dateTime(),
    ];
});
