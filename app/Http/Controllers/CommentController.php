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
        $cComments=$cPost->comments()->get();
        $cComments->map(function($comment,$key){
            $comment['owner']=$comment->getOwnerName();
        });
        return view('comments.index',[
            'topic'=>$topic,
            'post' => $cPost,
            'comments' => $cComments
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
        $cPost=Post::getPost($post);
        return view('comments.form',[
            'title'=>'New comment',
            'route'=>'comments.store',
            'routeArgs'=>['topic'=>$topic,'post'=>$post],
            'method'=>'post',
            'post'=>$cPost
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

        return redirect()->route('comments.index',[$topic,$post]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($topic,$post,$comment)
    {
        $cComment=Comment::getComment($comment);
        $this->authorize('update',[$cComment]);
        $cPost=Post::getPost($post);
        return view('comments.form',[
            'title'=>'Edit comment',
            'route'=>'comments.update',
            'routeArgs'=>['topic'=>$topic,'post'=>$post,'comment'=>$cComment->show_id],
            'method'=>'put',
            'post'=>$cPost,
            'comment'=>$cComment
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
        $cComment=Comment::getComment($comment);
        $this->authorize('update',[$cComment]);
        $cComment->update($this->validateComment($request));
        return redirect()->route('comments.index',[$topic,$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic,$post,$comment)
    {
        $cComment=Comment::getComment($comment);
        $this->authorize('delete',[$cComment]);
        $cComment->delete();
        return redirect()->route('comments.index',[$topic,$post]);
    }

    public function remove($topic,$post,$comment){
        $cComment=Comment::getComment($comment);
        $this->authorize('delete',[$cComment]);
        return view('comments.remove',[
            'topic'=>$topic,
            'post'=>$post,
            'comment'=>$cComment
        ]);
    }

    protected function validateComment($request)
    {
        return $request->validate([
            'body'=>'required',
        ]);
    }

}
