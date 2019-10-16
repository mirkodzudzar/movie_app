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

$factory->define(App\User::class, function(Faker $faker) {
    return [
      'first_name' => $faker->firstName,
      'last_name' => $faker->lastname,
      'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'state_of_birth' => $faker->state,
      'username' => $faker->unique()->firstName.$faker->lastName,
      'email' => $faker->unique()->safeEmail,
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'role_id' => $faker->numberBetween(1, 2),
      //'photo_id' => 1,
      'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Role::class, function(Faker $faker){
  return [
    'name' => $faker->randomElement(['administrator', 'subscriber', 'author'])
  ];
});

$factory->define(App\Photo::class, function(Faker $faker){
  return [
    // 'path' => 'no_image'
    'file' => ''
  ];
});
$factory->define(App\Movie::class, function(Faker $faker){
  return [
    'name' => $faker->name,
    'description' => $faker->text,
    'time_duration' => $faker->time($format = 'H:i:s', $max = 'now'),
    'release_date' => $faker->date($format = 'Y-m-d'),
    // 'director_id' => $faker->numberBetween(1, 5),
  ];
});

$factory->define(App\Genre::class, function(Faker $faker){
  return [
    'name' => $faker->randomElement(['horror', 'comedy', 'romance'])
  ];
});

$factory->define(App\Celebrity::class, function(Faker $faker){
  return [
    'first_name' => $faker->firstName,
    'last_name' => $faker->lastName,
    'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
    'state_of_birth' => $faker->state,
  ];
});

$factory->define(App\Price::class, function(Faker $faker){
  return [
    'value' => $faker->numberBetween(9, 999),
    'movie_id' => $faker->numberBetween(1, 10),
  ];
});

$factory->define(App\Profession::class, function(Faker $faker){
  return [
    'name' => $faker->randomElement(['actor', 'director', 'writer', 'producer'])
  ];
});
