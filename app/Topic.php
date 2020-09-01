<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Topic extends Model
{
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public static function getTopic($showID){
        $coll=Topic::where('show_id', $showID)->get();
        if($coll->isEmpty() || $coll->count()<1){
            return response()->view('errors.400');
        }else{
            $topic=$coll[0];
            $topic['owner']=$topic->getOwnerName();
            $topic['rPostDate']=$topic->getRecentPostDate();
            return $topic;
        }
    }

    protected $fillable = ['title', 'user_id', 'descr','show_id'];

    public static function getTopics($type){
        $topics= Topic::where('type',$type)->get();
        $topics->map(function($topic,$key){
            $topic['owner']=$topic->getOwnerName();
            $topic['rPostDate']=$topic->getRecentPostDate();
        });
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
