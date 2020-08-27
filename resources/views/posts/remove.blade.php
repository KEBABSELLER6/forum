@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <h3>Are you sure you want to delete the following post with all comments?</h3>
        </div>
        <div class="justify-content-between list-group-item form-group">            
            <h5 class="mb-1">{{ $post->title }}</h5>
            <p class="mb-1">{{ $post->descr }}</p>
        </div>
        <div class="d-flex justify-content-center">
            {!! Form::open(array('url' => '/topics/' . $topic . '/posts/' . $post->show_id, 'method' => 'delete')) !!}
            <div class="form-group">
                {!! Form::submit("Yes, I'm sure", array('class'=>array('btn','btn-primary'))) !!}
            </div>
            {!! Form::close() !!}
            <a class="btn btn-primary form-group" href="{{URL::previous()}}" style="margin-left: 20px ">No, I've changed my mind</a>
        </div>
    </div>
@endsection