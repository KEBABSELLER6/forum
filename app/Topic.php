<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public static function getTopic($showID){
        return Topic::where('show_id', $showID)->get()[0];
    }

    protected $fillable = ['title', 'user_id', 'descr','show_id'];

    public static function getTopics($type){
        $topics= Topic::where('type',$type)->get();
        return $topics;
    }

    public function getRecentPostDate(){
        $cPost=Topic::find($this->id)->posts()->latest('created_at')->first();
        if($cPost!=null){
            return $cPost->created_at;
        }else{
            return 'No post yet';
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getOwnerName(){
        return $this->user()->get()[0]->name;
    }
}
