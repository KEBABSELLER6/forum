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
        $cPosts=Topic::find($cTopic->id)->posts()->get();

        foreach($cPosts as $post){
            $result=Post::find($post->id)->comments()->latest('created_at')->first();
            if($result!=null){
                $post['recent_comment_at']=$result->created_at;
            } else {
                $post['recent_comment_at']='No comment yet';
            }
        }

        return view('posts.index',[
            'topic' => $cTopic,
            'posts' => $cPosts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topic)
    {
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
        $cTopic = Topic::getTopic($topic);
        $validatedRequest = $this->validatePost($request);
        Post::create([
            'title' => $validatedRequest['title'],
            'created_by' => $validatedRequest['created_by'],
            'descr' => $validatedRequest['descr'],
            'show_id'=>uniqid(),
            'topic_id'=>$cTopic->id
        ]);

        return redirect('/topics/' .$topic . '/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        return Post::getPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($topic,$post)
    {
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
        $cPost = Post::getPost($post);
        $cPost->update($this->validatePost($request));

        return redirect('/topics/' . $topic . '/posts/' .$cPost->show_id . '/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic,$post)
    {
        Post::where('show_id', $post)->get()[0]->delete();

        return redirect('/topics/'. $topic . '/posts/');
    }

    protected function validatePost($request){
        return $request->validate([
            'title' => 'required',
            'created_by' =>'required',
            'descr' =>'required'
        ]);
    }
}
