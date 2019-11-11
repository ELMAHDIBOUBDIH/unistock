<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Fakere $fakere){
    $faker = \Faker\Factory::create('fr_FR');
    $title = $faker->realText(30);
    return [
        'name' => $faker->name,
    ];
});
