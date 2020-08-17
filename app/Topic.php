<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public static function getTopicFromShowID($showID){
        return Topic::where('show_id', $showID)->get()[0];
    }
}
