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
        DB::table('directors')->truncate();
        DB::table('photos')->truncate();

        factory(App\Role::class, 2)->create();
        factory(App\User::class, 10)->create();
        // {
        //   $user->photos()->save(factory(App\Photo::class)->make());
        // });
        factory(App\Movie::class, 5)->create();
        factory(App\Genre::class, 3)->create();

        $genres = App\Genre::all();
        App\Movie::all()->each(function ($movie) use ($genres) {
            $movie->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        factory(App\Director::class, 5)->create();
    }
}
