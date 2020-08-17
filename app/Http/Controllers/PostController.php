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
        $cTopic=Topic::getTopicFromShowID($topic);
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
            'topic' => getTopicFromShowID($topic)
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
        $cTopic = Topic::getTopicFromShowID($topic);
        $cPost = new Post();

        $cPost->title=$request->title;
        $cPost->created_by=$request->creator;
        $cPost->descr=$request->descr;
        $cPost->show_id=uniqid();
        $cPost->topic_id=$cTopic->id;

        $cPost->save();

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
        return Post::getPostFromShowId($post);
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
            'topic' => Topic::getTopicFromShowID($topic),
            'post' => Post::getPostFromShowId($post)
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
        $cPost = Post::getPostFromShowId($post);

        $cPost->title=$request->title;
        $cPost->created_by=$request->creator;
        $cPost->descr=$request->descr;

        $cPost->save();

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
}
