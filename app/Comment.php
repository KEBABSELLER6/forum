<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static function getCommentFromShowID($showID){
        return Comment::where('show_id',$showID)->get()[0];
    }
}
