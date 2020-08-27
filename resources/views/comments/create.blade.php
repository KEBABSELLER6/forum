@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="jumbotron w-100">
                <h1 class="display-6">{{$post->title}}</h1>
                <p class="lead">{{$post->descr}}</p>
                <div class="justify-content-between">
                    <span class="badge badge-primary badge-pill">{{ $post->getOwnerName() }}</span>
                    <small>Created at : {{$post->getLastCommentDate()}}</small>
                </div>
            </div>
        </div>
        <h4>New comment</h4>
        {!! Form::open(array('url' => '/topics/' . $topic . '/posts/' . $post->show_id . '/comments', 'class'=>'form_wrapper')) !!}
            <div class="form-group">
                {!! Form::label('body', 'Comment body:') !!}
                {!! Form::textarea('body', '', array('class'=>array('form-control'), 'rows'=>4)) !!}
                @error('body')
                    <p class="invalid-feedback" style="display: inline">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="form_field">
                {!! Form::submit('Submit', array('class'=>array('btn','btn-primary'))) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection