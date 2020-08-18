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

    protected $fillable = ['title', 'created_by', 'descr','show_id'];

    public static function getTopics($type){
        $topics= Topic::where('type',$type)->get();

        foreach($topics as $topic){
            $result = Topic::find($topic->id)->posts()->latest('created_at')->first();
            if($result!=null){
                $topic['recent_post_at']=$result->created_at;
            } else {
                $topic['recent_post_at']='No post yet';
            }
        }
        
        return $topics;
    }
}
