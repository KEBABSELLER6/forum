<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->authorize('create',Topic::class);
        return view('topics.form',[
            'title'=>'New topic',
            'route'=>'topics.store',
            'routeArgs'=>[],
            'method'=>'post',
            'topic'=>null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Topic::class);
        $validatedRequest = $this->validateTopic($request);
        Topic::create([
            'title' => $validatedRequest['title'],
            'user_id' => auth()->user()->id,
            'descr' => $validatedRequest['descr'],
            'show_id' => uniqid()
        ]);

        return redirect()->route('topics.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($topic)
    {
        $cTopic=Topic::getTopic($topic);
        $this->authorize('update',[$cTopic]);
        return view('topics.form',[
            'title'=>'Edit topic',
            'route'=>'topics.update',
            'routeArgs'=>['topic'=>$cTopic->show_id],
            'method'=>'put',
            'topic'=>$cTopic
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
        $this->authorize('update',[$cTopic]);
        $cTopic->update($this->validateTopic($request));
        return redirect()->route('topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic)
    {
        $cTopic=Topic::getTopic($topic);
        $this->authorize('delete',[$cTopic]);
        $cTopic->delete();
        return redirect()->route('topics.index');
    }

    public function remove($topic){
        $cTopic=Topic::getTopic($topic);
        $this->authorize('delete',[$cTopic]);
        return view('topics.remove',[
            'topic'=>$cTopic
        ]);
    }

    protected function validateTopic($request){
        return $request->validate([
            'title' => 'required',
            'descr' =>'required'
        ]);
    }

}
