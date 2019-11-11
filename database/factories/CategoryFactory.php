<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;
use App\Category;

$factory->define(App\Category::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');
    $faker = \Faker\Factory::create('fr_FR');


    $parent = Category::take(10)->inRandomOrder()->first();
    if ($parent) {
        $parent_id = $parent->id;
    } else {
        $parent_id = null;
    }

    return [
        'name'        => $faker->sentence(rand(1, 2)),
        'description' => $faker->realText(200),
        'parent_id'   => $parent_id,

        'created_at'  => $faker->dateTime(),
        'updated_at'  => $faker->dateTime(),
    ];
});
