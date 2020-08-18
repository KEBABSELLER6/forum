<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static function getComment($showID){
        return Comment::where('show_id',$showID)->get()[0];
    }

    protected $fillable = ['body', 'created_by','show_id','post_id'];
}
