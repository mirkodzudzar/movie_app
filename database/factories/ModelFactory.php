<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

// $factory->define(Model::class, function (Faker $faker) {
//     return [
//         //
//     ];
// });

$factory->define(App\User::class, function (Faker $faker) {
    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastname,
      'username' => $faker->unique()->firstName.$faker->lastName,
      'email' => $faker->unique()->safeEmail,
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'role_id' => 1,
      'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Role::class, function(Faker $faker){
  return [
    'name' => $faker->randomElement(['administrator', 'subscriber'])
  ];
});

$factory->define(App\Photo::class, function(Faker $faker){
  return [
    'path' => 'no_image'
  ];
});
