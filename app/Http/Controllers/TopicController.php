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
        $this->authorize('create',Topic::class);
        $validatedRequest = $this->validateTopic($request);
        Topic::create([
            'title' => $validatedRequest['title'],
            'user_id' => auth()->user()->id,
            'descr' => $validatedRequest['descr'],
            'show_id' => uniqid()
        ]);

        return redirect('/topics');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($topic)
    {
        $this->authorize('update',Topic::class);
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
        $this->authorize('update',Topic::class);
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
        $this->authorize('delete',Topic::class);
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
