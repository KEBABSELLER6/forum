<?php

use Illuminate\Database\Seeder;

class AbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abilities')->insert(array(
            array(
                'name' => 'create_topic'
            ),
            array(
                'name' => 'create_post'
            ),
            array(
                'name' => 'create_comment'
            ),
            array(
                'name' => 'view_profile'
            ),


            array(
                'name' => 'delete_topic'
            ),
            array(
                'name' => 'delete_post'
            ),
            array(
                'name' => 'delete_comment'
            ),


            array(
                'name' => 'make_moderator'
            )
        ));
    }
}
