@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron w-100">
            <h1 class="display-6">{{$post->title}}</h1>
            <p class="lead">{{$post->descr}}</p>
            <div class="justify-content-between">
                <span class="badge badge-primary badge-pill">{{ $post->getOwnerName() }}</span>
                <small>Created at : {{$post->created_at}}</small>
            </div>
        </div>
    </div>
    <h4>{{$title}}</h4>
    {!! Form::open(array('route'=>array($route,$routeArgs), 'class'=>'form_wrapper', 'method' => $method)) !!}
    <div class="form-group">
        {!! Form::label('body', 'Comment body:') !!}
        {!! Form::textarea('body', isset($comment) ? $comment->body : '', array('class'=>array('form-control'),
        'rows'=>4)) !!}
        @component('components.form-error',['field'=>'body'])@endcomponent
    </div>
    @component('components.form-submit')@endcomponent
    {!! Form::close() !!}
</div>
@endsection