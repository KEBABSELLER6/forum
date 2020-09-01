<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Post extends Model
{
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public static function getPost($showID){
        $coll=Post::where('show_id',$showID)->get();
        if($coll->isEmpty() || $coll->count()<1){
            return response()->view('errors.400');
        }else {
            return $coll[0];
        }
    }

    protected $fillable = ['title', 'user_id', 'descr','show_id','topic_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getLastCommentDate(){
        $cComment=Post::find($this->id)->comments()->latest('created_at')->first();
        if($cComment!=null){
            return $cComment->created_at;
        }else{
            return 'No comment yet';
        }
    }

    public function getOwnerName(){
        return $this->user()->get()[0]->name;
    }

}
