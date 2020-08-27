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

        <ul class="list-group">
            @foreach ($comments as $comment)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="col-11 justify-content-between">
                            <div>
                                <span class="badge badge-primary badge-pill">{{ $comment->getOwnerName() }}</span>
                                <small>Created at : {{$comment->created_at}}</small>
                            </div>
                            <p class="mb-1">{{ $comment->body }}</p>
                    </div>
                    @canany(['update', 'delete'], $comment)
                    <div class="col-1 dropdown justify-content-between">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        @can('update', $comment)
                            <a class="dropdown-item" href="/topics/{{ $topic}}/posts/{{ $post->show_id }}/comments/{{$comment->show_id}}/edit">Edit post</a>
                        @endcan
                        @can('delete', $comment)
                            <a class="dropdown-item" href="/topics/{{ $topic}}/posts/{{ $post->show_id }}/comments/{{$comment->show_id}}/remove">Delete post</a>
                        @endcan
                        </div>
                    </div>
                    @endcanany
                </li>
            @endforeach
            @can('create', App\Comment::class)
            <a href="{{  route('comments.create',[$topic,$post->show_id]) }}" class="list-group-item list-group-item-action">
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