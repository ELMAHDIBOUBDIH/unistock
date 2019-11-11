<?php

use Faker\Generator as Fakere;
use Faker\Factory as Faker;

$factory->define(App\Employee::class, function (Fakere $fakere) {
    ini_set('memory_limit', '-1');
  
    $faker = \Faker\Factory::create('fr_FR');

    return [
      'company_name'     => $faker->company(),
      'first_name'       => $faker->firstName(),
      'last_name'        => $faker->lastName(),
      'gender'           => $faker->randomElement(['female','male']),
      'birthday'         => $faker->dateTime(),
      'tel'              => $faker->e164PhoneNumber(),
      'fax'              => $faker->e164PhoneNumber(),
      'email'            => $faker->email(),
      'address'          => $faker->address(),
      'image'            => $faker->imageUrl(),
      'qualification'    => $faker->word(),
      'recruitment_date' => $faker->dateTime(),
      'password'         => $faker->password(),
      'note'             => $faker->realText(rand(100, 200)),

      'created_at'       => $faker->dateTime(),
      'updated_at'       => $faker->dateTime(),
    ];
});
