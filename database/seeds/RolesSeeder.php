<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            array(
                'name' => 'user',
                'descr' => 'generic user'
            ),
            array(
                'name' => 'moderator',
                'descr' => 'moderator for the forum'
            ),
            array(
                'name' => 'admin',
                'descr' => 'admin for the forum'
            )
        ));
    }
}
