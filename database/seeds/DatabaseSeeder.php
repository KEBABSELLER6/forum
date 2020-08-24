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
        $this->call([
            UsersSeeder::class,
            RolesSeeder::class,
            AbilitiesSeeder::class,
            AbilityRoleSeeder::class,
            UserRoleSeeder::class,
            TopicsSeeder::class,
            PostsSeeder::class,
            CommentsSeeder::class
        ]);
    }
}
