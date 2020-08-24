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
        return view('topics.index', [
            'gTopics'=>Topic::getTopics('general'),
            'uTopics'=>Topic::getTopics('unique')
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
        $validatedRequest = $this->validateTopic($request);
        Topic::create([
            'title' => $validatedRequest['title'],
            'user_id' => 1,
            'descr' => $validatedRequest['descr'],
            'show_id' => uniqid()
        ]);

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
        return Topic::getTopic($topic);
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
            'topic' => Topic::getTopic($topic)
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
        $cTopic=Topic::getTopic($topic);
        $cTopic->update($this->validateTopic($request));
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
        Topic::getTopic($topic)->delete();
        return redirect('/topics');
    }

    protected function validateTopic($request){
        return $request->validate([
            'title' => 'required',
            'descr' =>'required'
        ]);
    }

}
