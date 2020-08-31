<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static function getComment($showID){
        return Comment::where('show_id',$showID)->get()[0];
    }

    protected $fillable = ['body', 'user_id','show_id','post_id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getUsername(){
        return $this->user()->get()[0]->name;
    }

    public function getOwnerName(){
        return $this->user()->get()[0]->name;
    }

    public function getTopic(){
        return $this->post()->get()[0]->topic()->get()[0];
    }
}
