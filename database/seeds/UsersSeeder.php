<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'asder',
            'email'=>'asder@example.com',
            'password'=>bcrypt('ASDasd123')
        ]);
    }
}
