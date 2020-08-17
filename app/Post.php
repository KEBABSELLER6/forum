<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public static function getPostFromShowId($showID){
        return Post::where('show_id',$showID)->get()[0];
    }
}
