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
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $username = $firstName."".$lastName;//unique()

    return [
      'first_name' => $firstName,
      'last_name' => $lastName,
      'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
      'state_of_birth' => $faker->state,
      'username' => $username,
      'email' => strtolower($username)."@".$faker->safeEmailDomain,
      'email_verified_at' => now(),
      'password' =>  bcrypt($faker->password(9)), // password
      'role_id' => $faker->numberBetween(1, 2),
      'photo_id' => null,
      'remember_token' => Str::random(10),
    ];
});

// $factory->define(App\User::class, 'first_name', function(Faker $faker) {
//   return [
//       'first_name' => 'Mirko',
//       'last_name' => 'Dzudzar',
//       'date_of_birth' => '1990-01-01',
//       'state_of_birth' => 'Serbia',
//       'username' => 'MirkoDzudzar',
//       'email' => 'mirkodzudzar@gmail.com',
//       'email_verified_at' => now(),
//       'password' => '123456789', // password
//       'role_id' => 1,
//       'photo_id' => null,
//       'remember_token' => Str::random(10),
//     ];
// });

$factory->define(App\News::class, function(Faker $faker){
  return [
    'title' => $faker->sentence(1, 11),
    'content' => $faker->paragraphs(rand(10, 15), true),
    'photo_id' => null,
  ];
});

$factory->define(App\Role::class, function(Faker $faker){
  return [
    'name' => $faker->randomElement(['administrator', 'subscriber', 'author'])
  ];
});

// $factory->define(App\Photo::class, function(Faker $faker){
//   return [
//     'file' => 'no_image'
//   ];
// });
$factory->define(App\Movie::class, function(Faker $faker){
  return [
    'name' => 'movie_name_'.$faker->numberBetween(9, 999),
    'description' => $faker->text,
    'time_duration' => $faker->time($format = 'H:i:s', $max = 'now'),
    'release_date' => $faker->date($format = 'Y-m-d'),
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
    'value' => $faker->numberBetween(100, 300),
    'movie_id' => $faker->numberBetween(1, 10),
  ];
});

$factory->define(App\Profession::class, function(Faker $faker){
  return [
    'name' => $faker->randomElement(['actor', 'director', 'writer', 'producer'])
  ];
});
