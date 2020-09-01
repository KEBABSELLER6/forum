@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="jumbotron w-100">
            <h1 class="display-6">{{$post->title}}</h1>
            <p class="lead">{{$post->descr}}</p>
            <div class="justify-content-between">
                <div>
                    <a class="badge badge-primary badge-pill text-light" href="{{route('profile.show', $post->user_id)}}">{{$post->owner}}</a>
                </div>
                <small>Created at : {{$post->created_at}}</small>
            </div>
        </div>
    </div>
    <ul class="list-group">
        @component('components.comment-list',['comments'=>$comments,'post'=>$post->show_id,'topic' =>$topic])@endcomponent
        @can('create', App\Comment::class)
        <a href="{{  route('comments.create',[$topic,$post->show_id]) }}"
            class="list-group-item list-group-item-action">
            <div class="row align-items-center">
                <div class="col justify-content-between">
                    <p class="mb-1">+ Add new comment</p>
                </div>
            </div>
        </a>
        @endcan
    </ul>
</div>
@endsection