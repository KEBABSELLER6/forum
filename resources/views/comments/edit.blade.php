@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-6">{{$post->title}}</h1>
                <p class="lead">{{$post->descr}}</p>
                <div class="justify-content-between">
                    <span class="badge badge-primary badge-pill">{{ $post->getOwnerName() }}</span>
                    <small>Created at : {{$post->getLastCommentDate()}}</small>
                </div>
            </div>
        </div>
        <h4>Edit comment</h4>
        {!! Form::open(array('url' => '/topics/' . $topic . '/posts/' . $post->show_id . '/comments/' . $comment->show_id, 'class'=>'form_wrapper', 'method' => 'put')) !!}
            <div class="form-group">
                <div>
                    {!! Form::label('body', 'Comment body:') !!}
                </div>
                {!! Form::textarea('body', $comment->body, array('class'=>array('form-control'), 'rows'=>4)) !!}
            </div>
            <div class="form_field">
                {!! Form::submit('Submit', array('class'=>array('btn','btn-primary'))) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection