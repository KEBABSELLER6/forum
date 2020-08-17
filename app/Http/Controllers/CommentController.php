<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic,$post)
    {
        $cPost= Post::getPostFromShowId($post);
        return view('comments.index',[
            'topic'=>$topic,
            'post' => $cPost,
            'comments' => Post::find($cPost->id)->comments()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topic,$post)
    {
        return view('comments.create',[
            'topic'=>$topic,
            'post'=>Post::getPostFromShowId($post)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$topic,$post)
    {
        $cPost=Post::getPostFromShowId($post);
        $comment = new Comment();

        $comment->body=$request->body;
        $comment->created_by=$request->creator;
        $comment->post_id=$cPost->id;
        $comment->show_id=uniqid();

        $comment->save();

        return redirect('/topics/' .$topic . '/posts/' . $post . '/comments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($comment)
    {
        return Comment::getCommentFromShowID($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($topic,$post,$comment)
    {
        return view('comments.edit',[
            'topic'=>$topic,
            'post'=>Post::getPostFromShowId($post),
            'comment'=>Comment::getCommentFromShowID($comment)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$topic,$post, $comment)
    {
        $cComment = Comment::getCommentFromShowID($comment);
        $cComment->body=$request->body;
        $cComment->created_by=$request->creator;

        $cComment->save();

        return redirect('/topics/' .$topic . '/posts/' . $post . '/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment)
    {
        Comment::where('show_id',$comment)->delete();

        return redirect('/topics/' .$topic . '/posts/' . $post . '/comments');
    }

}
