<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Comment extends Model
{
    public static function getComment($showID){
        $coll = Comment::where('show_id',$showID)->get();
        if($coll->isEmpty() || $coll->count()<1){
            return response()->view('errors.400');
        }else {
            return $coll[0]; 
        }
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
