<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('movies')->truncate();
        DB::table('genres')->truncate();
        DB::table('celebrities')->truncate();
        // DB::table('photos')->truncate();
        DB::table('prices')->truncate();
        // DB::table('images')->truncate();
        DB::table('professions')->truncate();


        factory(App\User::class, 10)->create();
        factory(App\Role::class, 3)->create();
        // factory(App\Photo::class, 1)->create();
        factory(App\Movie::class, 10)->create();
        factory(App\Genre::class, 3)->create();
        factory(App\Celebrity::class, 10)->create();
        factory(App\Price::class, 10)->create();
        factory(App\Profession::class, 4)->create();

        $genres = App\Genre::all();
        App\Movie::all()->each(function ($movie) use ($genres) {
            $movie->genres()->attach(
                $genres->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        $movies = App\Movie::all();
        App\User::all()->each(function ($user) use ($movies) {
            $user->movies()->attach(
                $movies->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        //Movie has many celebrities with some professions
        $celebrities = App\Celebrity::all();
        App\Movie::all()->each(function ($movie) use ($celebrities) {
            $movie->celebrities()->attach(
                $celebrities->random(rand(1,2))->pluck('id')->toArray(), ['profession_id' => rand(1, 4)]
              );
        });
    }
}
