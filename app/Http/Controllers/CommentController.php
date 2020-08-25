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
        $cPost= Post::getPost($post);
        return view('comments.index',[
            'topic'=>$topic,
            'post' => $cPost,
            'comments' => $cPost->comments()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topic,$post)
    {
        $this->authorize('create',Comment::class);
        return view('comments.create',[
            'topic'=>$topic,
            'post'=>Post::getPost($post)
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
        $this->authorize('create',Comment::class);
        $cPost=Post::getPost($post);
        $validetedRequest=$this->validateComment($request);
        Comment::create([
            'body'=>$validetedRequest['body'],
            'user_id'=>auth()->user()->id,
            'show_id'=>uniqid(),
            'post_id'=>$cPost->id
        ]);

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
        return Comment::getComment($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($topic,$post,$comment)
    {
        $this->authorize('update',Comment::class);
        return view('comments.edit',[
            'topic'=>$topic,
            'post'=>Post::getPost($post),
            'comment'=>Comment::getComment($comment)
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
        $this->authorize('update',Comment::class);
        $cComment = Comment::getComment($comment);
        $cComment->update($this->validateComment($request));

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
        $this->authorize('delete',Comment::class);
        Comment::where('show_id',$comment)->delete();

        return redirect('/topics/' .$topic . '/posts/' . $post . '/comments');
    }

    protected function validateComment($request)
    {
        return $request->validate([
            'body'=>'required',
        ]);
    }

}
