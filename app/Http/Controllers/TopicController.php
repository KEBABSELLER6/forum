<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generalTopics=Topic::where('type','general')->get();
        $uniqueTopics=Topic::where('type','unique')->get();

        foreach($generalTopics as $topic){
            $result = Topic::find($topic->id)->posts()->latest('created_at')->first();
            if($result!=null){
                $topic['recent_post_at']=$result->created_at;
            } else {
                $topic['recent_post_at']='No post yet';
            }
        }

        foreach($uniqueTopics as $topic){
            $result = Topic::find($topic->id)->posts()->latest('created_at')->first();
            if($result!=null){
                $topic['recent_post_at']=$result->created_at;

            } else {
                $topic['recent_post_at']='No post yet';
            }
        }

        return view('topics.index', [
            'genTopics'=>$generalTopics,
            'uniqTopics'=>$uniqueTopics
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cTopic = new Topic();

        $cTopic->title=$request->title;
        $cTopic->created_by=$request->creator;
        $cTopic->descr=$request->descr;
        $cTopic->show_id=uniqid();

        $cTopic->save();

        return redirect('/topics');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($topic)
    {
        return Topic::getTopicFromShowID($topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($topic)
    {
        return view('topics.edit',[
            'topic' => Topic::getTopicFromShowID($topic)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $topic)
    {
        $cTopic=Topic::getTopicFromShowID($topic);
        $cTopic->title=$request->title;
        $cTopic->created_by=$request->creator;
        $cTopic->descr=$request->descr;

        $cTopic->save();

        return redirect('/topics/' . $cTopic->show_id . '/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic)
    {
        Topic::getTopicFromShowID($topic)->delete();

        return redirect('/topics');
    }

}
