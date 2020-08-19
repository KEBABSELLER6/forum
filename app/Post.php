<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public static function getPost($showID){
        return Post::where('show_id',$showID)->get()[0];
    }

    protected $fillable = ['title', 'created_by', 'descr','show_id','topic_id'];

}
