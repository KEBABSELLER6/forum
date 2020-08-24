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
                'name' => 'view_content',
                'descr' => 'view topics, posts, comments'
            ),
            array(
                'name' => 'edit_content',
                'descr' => 'edit topics, posts, comments'
            ),
            array(
                'name' => 'delete_content',
                'descr' => 'delete topics, posts, comments'
            ),
            array(
                'name' => 'add_content',
                'descr' => 'add topics, posts, comments'
            ),
            array(
                'name' => 'make_moderator',
                'descr' => 'make a user moderator'
            ),
            array(
                'name' => 'view_profile',
                'descr' => 'view a users profile'
            ),
            array(
                'name' => 'edit_profile',
                'descr' => 'edit a profile'
            ),
        ));
    }
}
