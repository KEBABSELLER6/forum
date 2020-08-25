<?php

use Illuminate\Database\Seeder;

class AbilityRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ability_role')->insert(array(
            array(
                'ability_id' => '1',
                'role_id' => '1'
            ),
            array(
                'ability_id' => '2',
                'role_id' => '1'
            ),
            array(
                'ability_id' => '3',
                'role_id' => '1'
            ),
            array(
                'ability_id' => '4',
                'role_id' => '1'
            ),


            array(
                'ability_id' => '5',
                'role_id' => '2'
            ),
            array(
                'ability_id' => '6',
                'role_id' => '2'
            ),
            array(
                'ability_id' => '7',
                'role_id' => '2'
            ),


            array(
                'ability_id' => '8',
                'role_id' => '3'
            )
        ));
    }
}
