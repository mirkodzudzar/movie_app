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

        factory(App\Role::class, 2)->create();
        factory(App\User::class, 3)->create()->each(function($user) {

        $user->photos()->save(factory(App\Photo::class)->make());

      });

    }
}
