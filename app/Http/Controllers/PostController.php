<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic)
    {
        $cTopic=Topic::getTopic($topic);
        return view('posts.index',[
            'topic' => $cTopic,
            'posts' => Topic::find($cTopic->id)->posts()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topic)
    {
        $this->authorize('create',Post::class);
        return view('posts.create',[
            'topic' => Topic::getTopic($topic)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $topic)
    {
        $this->authorize('create',Post::class);
        $cTopic = Topic::getTopic($topic);
        $validatedRequest = $this->validatePost($request);
        Post::create([
            'title' => $validatedRequest['title'],
            'user_id' => auth()->user()->id,
            'descr' => $validatedRequest['descr'],
            'show_id'=>uniqid(),
            'topic_id'=>$cTopic->id
        ]);

        return redirect('/topics/' .$topic . '/posts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($topic,$post)
    {
        $this->authorize('update',[Post::getPost($post)]);
        return view('posts.edit',[
            'topic' => Topic::getTopic($topic),
            'post' => Post::getPost($post)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$topic,$post)
    {
        $cPost=Post::getPost($post);
        $this->authorize('update',[$cPost]);
        $cPost->update($this->validatePost($request));
        return redirect('/topics/' . $topic . '/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic,$post)
    {
        $cPost=Post::getPost($post);
        $this->authorize('delete',[$cPost]);
        $cPost->delete();
        return redirect('/topics/'. $topic . '/posts/');
    }

    public function remove($topic,$post){
        $cPost=Post::getPost($post);
        $this->authorize('delete',[$cPost]);
        return view('posts.remove',[
            'topic'=>$topic,
            'post'=>$cPost
        ]);
    }

    protected function validatePost($request){
        return $request->validate([
            'title' => 'required',
            'descr' =>'required'
        ]);
    }
}
